<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Adapter/EntityAdapter.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 19:11
 */

namespace DavidAnnebicque\TableBundle\Adapter;

use DavidAnnebicque\TableBundle\DTO\TableResult;
use DavidAnnebicque\TableBundle\DTO\TableState;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\CountWalker;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityAdapter extends TableAdapter implements DoctrineAdapterInterface
{
    /**
     * EntityCollector constructor.
     */
    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setRequired('class')
            ->setAllowedTypes('class', 'string')
            ->setDefault('query_alias', 'e')
            ->setAllowedTypes('query_alias', 'string')
            ->setDefault('query', null)
            ->setAllowedTypes('query', ['callable', 'null'])
            /*
             * Paginator / query options (use for optimization)
             *
             * To fetch large data (~over 1m) use options :
             *  [
             *      'fetch_join_collection' => false,
             *      'use_output_walker' => false,
             *      'use_distinct_hint' => false
             * ]
             */
            ->setDefault('fetch_join_collection', true)
            ->setAllowedTypes('fetch_join_collection', 'bool')
            ->setDefault('use_output_walker', null)
            ->setAllowedTypes('use_output_walker', ['null', 'bool'])
            ->setDefault('use_distinct_hint', true)
            ->setAllowedTypes('use_distinct_hint', 'bool');
    }

    public function getResult(TableState $state, array $options): TableResult
    {
        $query = $this->getQueryBuilder($state, $options)->getQuery();
        if (false === $options['use_distinct_hint']) {
            $query->setHint(CountWalker::HINT_DISTINCT, false);
        }

        $paginator = new Paginator($query, $options['fetch_join_collection']);
        if (null !== $options['use_output_walker']) {
            $paginator->setUseOutputWalkers($options['use_output_walker']);
        }

        return new TableResult($paginator);
    }

    public function getQueryBuilder(TableState $state, array $options): QueryBuilder
    {
        $formData = $state->getFormData();

        $qb = $this->em->createQueryBuilder()
            ->select($options['query_alias'])
            ->from($options['class'], $options['query_alias']);

        if (is_callable($options['query'])) {
            call_user_func($options['query'], $qb, $formData);
        }

        // pagination
        $qb->setFirstResult($state->getStart());
        if ($state->getLength() >= 0) {
            $qb->setMaxResults($state->getLength());
        }
        // order by
        foreach ($state->getOrderBy() as [$column, $direction]) {
            foreach ($column->getOrderBy() as $path) {
                // if path is not a sub property path, prefix it by alias
                if (!str_contains((string) $path, '.')) {
                    $path = sprintf('%s.%s', $options['query_alias'], $path);
                }

                $qb->addOrderBy($path, strtoupper($direction));
            }
        }

        return $qb;
    }
}

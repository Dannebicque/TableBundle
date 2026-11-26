<?php

namespace Dannebicque\TableBundle\Tests\Fixtures;

use Dannebicque\TableBundle\Adapter\EntityAdapter;
use Dannebicque\TableBundle\Column\PropertyColumnType;
use Dannebicque\TableBundle\TableBuilder;
use Dannebicque\TableBundle\TableType;
use Dannebicque\TableBundle\Tests\Fixtures\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EntityTableType extends TableType
{
    public function buildTable(TableBuilder $builder, array $options): void
    {
        $builder
            ->addFilter('search', TextType::class)
            ->addColumn('name', PropertyColumnType::class)
            ->useAdapter(EntityAdapter::class, [
                'class' => User::class,
                'query' => function (QueryBuilder $qb, array $filters) {
                    if (isset($filters['search'])) {
                        $qb->andWhere('e.name LIKE :s')->setParameter('s', $filters['search'].'%');
                    }
                },
            ]);
    }
}

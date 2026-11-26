<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Column/SelectColumnType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 19:11
 */

namespace Dannebicque\TableBundle\Column;

use Dannebicque\TableBundle\Security\ActionToken;
use Dannebicque\TableBundle\Utils\HtmlUtils;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use function is_callable;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SelectColumnType extends ColumnType
{
    protected PropertyAccessorInterface $accessor;

    public function __construct(
        protected TranslatorInterface $translator,
        protected EntityManagerInterface $entityManager,
        protected RouterInterface $router,
        protected ActionToken $actionToken,
    ) {
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    public function render(mixed $rowData, array $options): string
    {
        $obj = $this->accessor->getValue($rowData, $options['property_path']); // on récupère l'objet de la liaison

        $html = '<select class="'.HtmlUtils::escape($options['class_select']).'"'.$this->liveUpdateAttributes($rowData, $options).'>';

        if (false === $options['required']) {
            $html .= '<option value="" selected>'.HtmlUtils::escape($this->translator->trans('select.choose', [], 'da_table')).'</option>';
        }

        if (null !== $options['choices']) {
            // on a un tableau
            foreach ($options['choices'] as $key => $value) {
                if (null !== $obj && $value === (\is_object($obj) ? $obj->getId() : $obj)) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }

                $html .= '<option value="'.HtmlUtils::escape($value).'" '.$selected.'>'.HtmlUtils::escape($key).'</option>';
            }
        } elseif (null !== $options['entity']) {
            $em = $this->entityManager->getRepository($options['entity']);
            // on a une entity
            if (null !== $options['query_builder']) {
                $queryBuilder = $options['query_builder'];
                if (is_callable($queryBuilder)) {
                    $queryBuilder = $queryBuilder($em);

                    if (null !== $queryBuilder && !$queryBuilder instanceof QueryBuilder) {
                        throw new UnexpectedTypeException($queryBuilder, QueryBuilder::class);
                    }
                }
                $datas = $queryBuilder->getQuery()->getResult();
            } else {
                $datas = $em->findAll();
            }
            foreach ($datas as $data) {
                if (null !== $obj && $data->getId() === $obj->getId()) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }

                $lib = $this->accessor->getValue($data, $options['choice_label']);

                $html .= '<option value="'.HtmlUtils::escape($data->getId()).'" '.$selected.'>'.HtmlUtils::escape($lib).'</option>';
            }
        }

        $html .= '</select>';

        return $html;
    }

    private function liveUpdateAttributes(mixed $rowData, array $options): string
    {
        if (!$options['live_update']) {
            return '';
        }

        $params = $options['live_update_params'] ?: [];
        if (is_callable($params)) {
            $params = $params($rowData);
        }
        $routeParams = $options['live_update_route_params'];
        if (is_callable($routeParams)) {
            $routeParams = $routeParams($rowData);
        }

        $attributes = [
            'data-live-update' => '1',
            'data-route' => $this->router->generate($options['live_update_path'], $routeParams),
            'data-params' => json_encode((object) $params, JSON_THROW_ON_ERROR),
        ];
        if (null !== $token = $this->actionToken->get($options['csrf_token_id'])) {
            $attributes['data-token'] = $token;
        }

        return ' '.trim(HtmlUtils::to_attr($attributes));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('property_path', fn (Options $options) => $options['id'])
            ->setDefault('order', false)
            ->setDefault('class', 'text-center row-selector')
            ->setDefault('class_select', 'form-control')
            ->setDefault('translation_domain', null)
            ->setDefault('is_safe_html', true)
            ->setDefault('choice_id', 'id')
            ->setDefault('choice_label', 'libelle')
            ->setDefault('choices', null)
            ->setDefault('entity', null)
            ->setDefault('query_builder', null)
            ->setRequired('choices')
            ->setDefault('live_update', false)
            ->setDefault('live_update_params', '')
            ->setDefault('live_update_path', '')
            ->setDefault('live_update_route_params', [])
            ->setDefault('csrf_token_id', 'live_update')
            ->setDefault('required', false);
    }
}

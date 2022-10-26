<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/Table/src/TableType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 20/05/2022 07:40
 */

namespace DavidAnnebicque\TableBundle;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TableType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('id')
            ->setAllowedTypes('id', 'string')
            ->setDefined('class')
            ->setAllowedTypes('class', 'string')
            ->setDefault('paging', true)
            ->setAllowedTypes('paging', 'bool')
            ->setDefault('length_change', false)
            ->setAllowedTypes('length_change', 'bool')
            ->setDefault('length_menu', [30, 60, 90, 120, 150, 180])
            ->setAllowedTypes('length_menu', 'array')
            ->setRequired('page_length')
            ->setAllowedTypes('page_length', 'int')
            ->setDefault('orderable', true)
            ->setAllowedTypes('orderable', 'bool')
            ->setDefault('template', '@DavidAnnebicqueTable/table.html.twig')
            ->setAllowedTypes('template', 'string');

        $resolver
            ->setDefault('load_url', null)
            ->setAllowedTypes('load_url', ['string', 'null'])
            ->setDefault('rowreorder_url', null)
            ->setAllowedTypes('rowreorder_url', ['string', 'null']);

        $resolver
            ->setDefault('toolbar_form_name', fn (Options $options) => sprintf('%s_tbf', $options['id']))
            ->setAllowedTypes('toolbar_form_name', 'string')
            ->setDefault('toolbar_form_options', [
                'validation_groups' => false,
                'csrf_protection' => false,
                'label' => false,
                'required' => false,
                'method' => 'GET',
            ])
            ->setAllowedTypes('toolbar_form_options', 'array')
            ->setDefault('toolbar_template', '@DavidAnnebicqueTable/filters.html.twig')
            ->setAllowedTypes('toolbar_template', 'string')
            ->setDefault('toolbar_form_data', null);
    }

    public function buildTable(TableBuilder $builder, array $options): void
    {
    }
}

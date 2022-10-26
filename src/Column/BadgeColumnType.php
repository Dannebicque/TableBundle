<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Column/BadgeColumnType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/08/2021 13:40
 */

namespace DA\TableBundle\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;

class BadgeColumnType extends PropertyColumnType
{
    public function renderProperty(mixed $value, array $options): string
    {
        return sprintf('<span class="badge %s">%s<span>', $options['badge_class'], $value);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefault('badge_class', 'bg-primary')
            ->setAllowedTypes('badge_class', ['null', 'string'])
            ->setDefault('is_safe_html', true);
    }
}

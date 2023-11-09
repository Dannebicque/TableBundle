<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Column/DateColumnType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 19:11
 */

namespace Dannebicque\TableBundle\Column;

use DateTimeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateColumnType extends PropertyColumnType
{
    public function renderProperty(mixed $value, array $options): string
    {
        return $value instanceof DateTimeInterface ? $value->format($options['format']) : (string) $value;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('format', 'd/m/Y')
            ->setAllowedTypes('format', 'string');
    }
}

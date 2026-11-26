<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Column/PropertyColumnType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 20:09
 */

namespace Dannebicque\TableBundle\Column;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class PropertyColumnType extends ColumnType
{
    protected PropertyAccessorInterface $accessor;

    /**
     * PropertyColumn constructor.
     */
    public function __construct()
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    public function render(mixed $rowData, array $options): string
    {
        return $this->renderProperty($this->getPropertyValue($rowData, $options['property_path']), $options);
    }

    public function renderProperty(mixed $value, array $options): string
    {
        return $this->displayValue($value, $options);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('property_path', fn (Options $options) => $options['id'])
            ->setAllowedTypes('property_path', 'string')
            ->setDefault('order', null)
            ->setDefault('format_datetime', 'd/m/Y')
            ->setDefault('order_by', fn (Options $options) => $options['property_path']);
    }

    public function displayValue(mixed $value, array $options): string
    {
        return match (true) {
            $value instanceof \DateTimeInterface => $value->format($options['format_datetime']),
            $value instanceof \BackedEnum => (string) $value->value,
            $value instanceof \UnitEnum => $value->name,
            default => (string) $value,
        };
    }

    protected function getPropertyValue(mixed $rowData, string $path): mixed
    {
        // Lignes sous forme de tableaux (CallableAdapter) : « name » équivaut à « [name] »
        if (\is_array($rowData) && !str_starts_with($path, '[')) {
            $path = sprintf('[%s]', $path);
        }

        return $this->accessor->getValue($rowData, $path);
    }
}

<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Column/CheckBoxColumnType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 20:09
 */

namespace Dannebicque\TableBundle\Column;

use Dannebicque\TableBundle\Utils\HtmlUtils;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class CheckBoxColumnType extends ColumnType
{
    /**
     * CheckBoxColumnType constructor.
     */
    public function __construct(protected TranslatorInterface $translator)
    {
    }

    public function render(mixed $rowData, array $options): string
    {
        $value = is_callable($options['value']) ? $options['value']($rowData) : $this->rowId($rowData);

        return sprintf('<div class="form-check"><input class="form-check-input position-static row-selector" type="checkbox" value="%s"></div>', HtmlUtils::escape($value));
    }

    private function rowId(mixed $rowData): mixed
    {
        if (\is_array($rowData)) {
            return $rowData['id'] ?? '';
        }

        return \is_object($rowData) && method_exists($rowData, 'getId') ? $rowData->getId() : '';
    }

    private function labelTemplate(): string
    {
        return '<div class="form-check"><input class="form-check-input position-static row-selector" type="checkbox"></div>';
    }

    /**
     * {}.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('value', null)
            ->setAllowedTypes('value', ['null', 'callable'])
            ->setDefault('order', false)
            ->setDefault('class', 'text-center')
            ->setDefault('label', $this->labelTemplate())
            ->setDefault('translation_domain', null)
            ->setDefault('width', '40px')
            ->setDefault('is_safe_html', true);
    }
}

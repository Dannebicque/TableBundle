<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/Table/src/TableRenderer.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 24/10/2022 15:20
 */

namespace DavidAnnebicque\TableBundle;

use DavidAnnebicque\TableBundle\DTO\Column;
use DavidAnnebicque\TableBundle\DTO\Table;
use DavidAnnebicque\TableBundle\DTO\Toolbar;
use Twig\Environment;

class TableRenderer
{
    /**
     * DataTableRenderer constructor.
     */
    public function __construct(protected Environment $twig)
    {
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function render(Table $table): string
    {
        return $this->twig->render($table->getOption('template'), $this->view($table));
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function renderToolbar(Toolbar $toolbar): string
    {
        return $this->twig->render($toolbar->getOption('toolbar_template'), $this->toolbarView($toolbar));
    }

    protected function view(Table $dataTable): array
    {
        $options = $dataTable->getOptions();

        $vars = [];
        $vars['toolbar'] = $dataTable->getToolbar();
        $vars['template'] = $options['template'];
        $vars['id'] = $options['id'];
        $vars['attr'] = [
            'id' => $options['id'],
            'class' => 'datable-container',
            'data-options' => json_encode($this->getJsOptions($dataTable), JSON_THROW_ON_ERROR),
        ];

        if ($options['paging']) {
            $vars['lengthChange'] = $options['length_change'];
            $vars['pageLength'] = $options['page_length'];
            $vars['lengthMenu'] = $options['length_menu'];
        }

        $vars['paging'] = $options['paging'];
        $vars['paging_attr'] = [
            'id' => 'id_paging',
            'lengthChange' => $options['length_change'],
            'pageLength' => $options['page_length'],
            'lengthMenu' => $options['length_menu'],
        ];
        $vars['table_attr'] = [
            'class' => $options['class'] .= ' datable',
        ];
        $vars['columns'] = array_map(fn (Column $c) => $this->columnView($c), $dataTable->getColumns());

        return $vars;
    }

    protected function getJsOptions(Table $dataTable): array
    {
        $options = $dataTable->getOptions();

        // js options
        $jsOptions = [];

        $jsOptions['ajax'] = [
            'url' => $options['load_url'],
        ];

        if ($options['paging']) {
            $jsOptions['paging_id'] = 'id_paging';
            $jsOptions['paging'] = true;
        } else {
            $jsOptions['paging'] = false;
        }

        $jsOptions['ordering'] = $options['orderable'];

        // columns options
        $jsOptions['columns'] = [];
        $jsOptions['order'] = [];

        foreach ($dataTable->getColumns() as $name => $column) {
            if ($column->isOrderable()) {
                $jsOptions['order'][] = [
                    $name,
                    strtolower($column->getDefaultOrder()),
                ];
            }

            $jsOptions['columns'][] = $this->getColumnJsOptions($column);
        }

        return $jsOptions;
    }

    protected function columnView(Column $column): array
    {
        $options = $column->getOptions();

        $vars = [];
        $vars['attr'] = [
            'class' => $options['class'],
            'id' => $options['id'],
            'order' => $column->getDefaultOrder(),
            'style' => $options['width'] ? sprintf('width:%s', $options['width']) : null,
        ];

        $vars['label'] = $options['label'];
        $vars['translation_domain'] = $options['translation_domain'];

        return $vars;
    }

    protected function getColumnJsOptions(Column $column): array
    {
        return [
            'orderable' => $column->isOrderable(),
            'order' => $column->getDefaultOrder(),
            'className' => $column->getOption('class'),
            'id' => $column->getOption('id'),
        ];
    }

    protected function toolbarView(Toolbar $toolbar): array
    {
        $options = $toolbar->getOptions();

        $vars = [];
        $vars['template'] = $options['toolbar_template'];
        $vars['form'] = $toolbar->getForm()->createView();
        $vars['widget'] = $toolbar->getWidget()->createView();

        return $vars;
    }
}

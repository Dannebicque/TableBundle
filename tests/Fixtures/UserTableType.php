<?php

namespace Dannebicque\TableBundle\Tests\Fixtures;

use Dannebicque\TableBundle\Column\BadgeColumnType;
use Dannebicque\TableBundle\Column\BooleanColumnType;
use Dannebicque\TableBundle\Column\CheckBoxColumnType;
use Dannebicque\TableBundle\Column\DateColumnType;
use Dannebicque\TableBundle\Column\LinkColumnType;
use Dannebicque\TableBundle\Column\PropertyColumnType;
use Dannebicque\TableBundle\Column\WidgetColumnType;
use Dannebicque\TableBundle\DTO\TableResult;
use Dannebicque\TableBundle\DTO\TableState;
use Dannebicque\TableBundle\TableBuilder;
use Dannebicque\TableBundle\TableType;
use Dannebicque\TableBundle\Widget\Type as W;
use Dannebicque\TableBundle\Widget\WidgetBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserTableType extends TableType
{
    public static ?TableState $lastState = null;

    public function buildTable(TableBuilder $builder, array $options): void
    {
        $builder
            ->addFilter('search', TextType::class)
            ->addWidget('add', W\AddLinkType::class, ['route' => 'users'])
            ->addWidget('export', W\ExportDropdownType::class, ['route' => 'users'])
            ->addWidget('group', W\ButtonGroupType::class, ['build' => fn (WidgetBuilder $b) => $b->add('one', W\ButtonType::class)])
            ->addWidget('empty', W\ButtonDropdownType::class)
            ->addWidget('plain')
            ->addWidget('modal', W\StimulusButtonModalType::class, ['modalUrl' => '/x'])
            ->addColumn('select', CheckBoxColumnType::class)
            ->addColumn('name', PropertyColumnType::class, ['order' => 'ASC'])
            ->addColumn('badge', BadgeColumnType::class, ['property_path' => 'name'])
            ->addColumn('active', BooleanColumnType::class)
            ->addColumn('born', DateColumnType::class)
            ->addColumn('link', LinkColumnType::class, ['property_path' => 'name'])
            ->addColumn('actions', WidgetColumnType::class, ['build' => function (WidgetBuilder $b) {
                $b->add('show', W\RowShowLinkType::class, ['route' => 'users']);
                $b->add('edit', W\RowEditLinkType::class, ['route' => 'users']);
                $b->add('copy', W\RowDuplicateLinkType::class, ['route' => 'users']);
                $b->add('delete', W\RowDeleteLinkType::class, ['route' => 'users']);
                $b->add('modal', W\RowModalLinkType::class, ['route' => 'users']);
            }])
            ->useAdapter(function (TableState $state): TableResult {
                self::$lastState = $state;

                return new TableResult([['name' => '<script>x</script>', 'active' => true, 'born' => new \DateTimeImmutable('2000-01-31')]], 95);
            });
    }
}

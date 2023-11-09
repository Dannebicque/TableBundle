<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DependencyInjection/services.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 22:24
 */

namespace Dannebicque\TableBundle\DependencyInjection;

use Dannebicque\TableBundle\Adapter\CallableAdapter;
use Dannebicque\TableBundle\Adapter\EntityAdapter;
use Dannebicque\TableBundle\Column\BadgeColumnType;
use Dannebicque\TableBundle\Column\BadgeSeuilColumnType;
use Dannebicque\TableBundle\Column\BooleanColumnType;
use Dannebicque\TableBundle\Column\CheckBoxColumnType;
use Dannebicque\TableBundle\Column\ColumnType;
use Dannebicque\TableBundle\Column\DateColumnType;
use Dannebicque\TableBundle\Column\DetailsHandleColumnType;
use Dannebicque\TableBundle\Column\EntityColumnType;
use Dannebicque\TableBundle\Column\LinkColumnType;
use Dannebicque\TableBundle\Column\ManyColumnType;
use Dannebicque\TableBundle\Column\PropertyColumnType;
use Dannebicque\TableBundle\Column\SelectColumnType;
use Dannebicque\TableBundle\Column\WidgetColumnType;
use Dannebicque\TableBundle\TableRegistry;
use Dannebicque\TableBundle\Widget\Type\AddLinkType;
use Dannebicque\TableBundle\Widget\Type\ButtonDropdownType;
use Dannebicque\TableBundle\Widget\Type\ButtonGroupType;
use Dannebicque\TableBundle\Widget\Type\ButtonType;
use Dannebicque\TableBundle\Widget\Type\ExportDropdownType;
use Dannebicque\TableBundle\Widget\Type\LinkType;
use Dannebicque\TableBundle\Widget\Type\RowDeleteLinkType;
use Dannebicque\TableBundle\Widget\Type\RowDuplicateLinkType;
use Dannebicque\TableBundle\Widget\Type\RowEditLinkType;
use Dannebicque\TableBundle\Widget\Type\RowLinkType;
use Dannebicque\TableBundle\Widget\Type\RowModalLinkType;
use Dannebicque\TableBundle\Widget\Type\RowShowLinkType;
use Dannebicque\TableBundle\Widget\Type\SelectChangeType;
use Dannebicque\TableBundle\Widget\Type\StimulusButtonModalType;
use Dannebicque\TableBundle\Widget\Type\WidgetType;
use Dannebicque\TableBundle\Widget\WidgetRegistry;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();
    $services->defaults()
        ->private()
        ->autowire()
        ->autoconfigure(false);

    $services->set(CallableAdapter::class)->tag(TableRegistry::TAG_ADAPTER);
    $services->set(EntityAdapter::class)->tag(TableRegistry::TAG_ADAPTER);

    $services->set(EntityColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(PropertyColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(BadgeColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(BadgeSeuilColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(CheckBoxColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(ColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(SelectColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(BooleanColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(DateColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(DetailsHandleColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(LinkColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(ManyColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);
    $services->set(WidgetColumnType::class)->tag(TableRegistry::TAG_COLUMN_TYPE);

    //Widget
    $services->set(AddLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(ButtonDropdownType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(ButtonGroupType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(ButtonType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(LinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(RowDeleteLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(RowEditLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(RowLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(RowModalLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(RowShowLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(RowDuplicateLinkType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(WidgetType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(SelectChangeType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(StimulusButtonModalType::class)->tag(WidgetRegistry::TAG_TYPE);
    $services->set(ExportDropdownType::class)->tag(WidgetRegistry::TAG_TYPE);
};

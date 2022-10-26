<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DependencyInjection/services.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 22:24
 */

namespace DavidAnnebicque\TableBundle\DependencyInjection;

use DavidAnnebicque\TableBundle\Adapter\CallableAdapter;
use DavidAnnebicque\TableBundle\Adapter\EntityAdapter;
use DavidAnnebicque\TableBundle\Column\BadgeColumnType;
use DavidAnnebicque\TableBundle\Column\BadgeSeuilColumnType;
use DavidAnnebicque\TableBundle\Column\BooleanColumnType;
use DavidAnnebicque\TableBundle\Column\CheckBoxColumnType;
use DavidAnnebicque\TableBundle\Column\ColumnType;
use DavidAnnebicque\TableBundle\Column\DateColumnType;
use DavidAnnebicque\TableBundle\Column\DetailsHandleColumnType;
use DavidAnnebicque\TableBundle\Column\EntityColumnType;
use DavidAnnebicque\TableBundle\Column\LinkColumnType;
use DavidAnnebicque\TableBundle\Column\ManyColumnType;
use DavidAnnebicque\TableBundle\Column\PropertyColumnType;
use DavidAnnebicque\TableBundle\Column\SelectColumnType;
use DavidAnnebicque\TableBundle\Column\WidgetColumnType;
use DavidAnnebicque\TableBundle\TableRegistry;
use DavidAnnebicque\TableBundle\Widget\Type\AddLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\ButtonDropdownType;
use DavidAnnebicque\TableBundle\Widget\Type\ButtonGroupType;
use DavidAnnebicque\TableBundle\Widget\Type\ButtonType;
use DavidAnnebicque\TableBundle\Widget\Type\ExportDropdownType;
use DavidAnnebicque\TableBundle\Widget\Type\LinkType;
use DavidAnnebicque\TableBundle\Widget\Type\RowDeleteLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\RowDuplicateLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\RowEditLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\RowLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\RowModalLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\RowShowLinkType;
use DavidAnnebicque\TableBundle\Widget\Type\SelectChangeType;
use DavidAnnebicque\TableBundle\Widget\Type\StimulusButtonModalType;
use DavidAnnebicque\TableBundle\Widget\Type\WidgetType;
use DavidAnnebicque\TableBundle\Widget\WidgetRegistry;
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

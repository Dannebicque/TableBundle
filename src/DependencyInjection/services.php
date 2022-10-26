<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DependencyInjection/services.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 22:24
 */

namespace DA\TableBundle\DependencyInjection;

use DA\TableBundle\Adapter\CallableAdapter;
use DA\TableBundle\Adapter\EntityAdapter;
use DA\TableBundle\Column\BadgeColumnType;
use DA\TableBundle\Column\BadgeSeuilColumnType;
use DA\TableBundle\Column\BooleanColumnType;
use DA\TableBundle\Column\CheckBoxColumnType;
use DA\TableBundle\Column\ColumnType;
use DA\TableBundle\Column\DateColumnType;
use DA\TableBundle\Column\DetailsHandleColumnType;
use DA\TableBundle\Column\EntityColumnType;
use DA\TableBundle\Column\LinkColumnType;
use DA\TableBundle\Column\ManyColumnType;
use DA\TableBundle\Column\PropertyColumnType;
use DA\TableBundle\Column\SelectColumnType;
use DA\TableBundle\Column\WidgetColumnType;
use DA\TableBundle\TableRegistry;
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
};

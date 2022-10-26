<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DependencyInjection/DATableBundleExtension.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 14:37
 */

namespace DA\TableBundle\DependencyInjection;

use DA\TableBundle\Adapter\TableAdapter;
use DA\TableBundle\Column\ColumnType;
use DA\TableBundle\TableRegistry;
use DA\TableBundle\TableType;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DATableExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/'));
        $loader->load('services.php');

        $container->registerForAutoconfiguration(TableAdapter::class)->addTag(TableRegistry::TAG_ADAPTER);
        $container->registerForAutoconfiguration(TableType::class)->addTag(TableRegistry::TAG_TABLE_TYPE);
        $container->registerForAutoconfiguration(ColumnType::class)->addTag(TableRegistry::TAG_COLUMN_TYPE);
    }

    public function prepend(ContainerBuilder $container)
    {
        $twigConfig = [];
        $twigConfig['paths'][__DIR__.'/../Resources/views'] = 'da_table';
        $twigConfig['paths'][__DIR__.'/../Resources/public'] = 'da_table.public';
        $container->prependExtensionConfig('twig', $twigConfig);
    }

    public function getAlias(): string
    {
        return 'da_table';
    }
}

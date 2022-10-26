<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DependencyInjection/Compiler/TableCompilerPass.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 14:39
 */

namespace DavidAnnebicque\TableBundle\DependencyInjection\Compiler;

use DavidAnnebicque\TableBundle\TableRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class TableCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container): void
    {
        $registry = $container->getDefinition('da_table.table_registry');
        $this->addToRegistry($container, $registry, TableRegistry::TAG_ADAPTER, 'registerAdapter');
        $this->addToRegistry($container, $registry, TableRegistry::TAG_COLUMN_TYPE, 'registerColumnType');
        $this->addToRegistry($container, $registry, TableRegistry::TAG_TABLE_TYPE, 'registerType');
    }

    private function addToRegistry(ContainerBuilder $container, Definition $registry, string $tag, string $method): void
    {
        $taggedServices = $container->findTaggedServiceIds($tag);

        foreach ($taggedServices as $id => $tags) {
            $registry->addMethodCall($method, [$id, new Reference($id)]);
        }
    }
}

<?php

namespace Dannebicque\TableBundle\DependencyInjection\Compiler;

use Dannebicque\TableBundle\Adapter\EntityAdapter;
use Dannebicque\TableBundle\Column\SelectColumnType;
use Dannebicque\TableBundle\Widget\Type\SelectChangeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Doctrine est optionnel : sans EntityManager, les services qui en dépendent sont retirés.
 */
class OptionalDoctrinePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if ($container->has(EntityManagerInterface::class)) {
            return;
        }

        foreach ([EntityAdapter::class, SelectColumnType::class, SelectChangeType::class] as $id) {
            $container->removeDefinition($id);
        }
    }
}

<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DATableBundle.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 14:35
 */

namespace Dannebicque\TableBundle;

use Dannebicque\TableBundle\DependencyInjection\Compiler\TableCompilerPass;
use Dannebicque\TableBundle\DependencyInjection\Compiler\WidgetCompilerPass;
use Dannebicque\TableBundle\DependencyInjection\TableExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DannebicqueTableBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TableCompilerPass());
        $container->addCompilerPass(new WidgetCompilerPass());

    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new TableExtension();
        }

        return $this->extension;
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}

<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/TableBundle/src/DATableBundle.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2022 14:35
 */

namespace DavidAnnebicque\TableBundle;

use DavidAnnebicque\TableBundle\DependencyInjection\Compiler\TableCompilerPass;
use DavidAnnebicque\TableBundle\DependencyInjection\DATableExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DATableBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TableCompilerPass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new DATableExtension();
        }

        return $this->extension;
    }
}

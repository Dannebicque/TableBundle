<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Widget/Type/RowLinkType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/08/2021 13:54
 */

namespace DavidAnnebicque\TableBundle\Widget\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

class RowLinkType extends LinkType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('text', false)
            ->setDefault('class', 'table-link');
    }
}

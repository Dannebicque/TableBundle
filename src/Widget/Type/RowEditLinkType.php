<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Widget/Type/RowEditLinkType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 23/10/2021 12:18
 */

namespace DavidAnnebicque\TableBundle\Widget\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

class RowEditLinkType extends RowLinkType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('title', 'action.edit')
            ->setDefault('icon', $this->parameterBag->get('iconEdit'))
            ->setDefault('class', 'btn btn-square btn-warning-outline  me-1');
    }
}

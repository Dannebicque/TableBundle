<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Widget/Type/RowDuplicateLinkType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 23/10/2021 12:18
 */

namespace DavidAnnebicque\TableBundle\Widget\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

class RowDuplicateLinkType extends RowLinkType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefault('title', 'action.duplicate')
            ->setDefault('icon', $this->parameterBag->get('iconDuplicate'))
            ->setDefault('class', 'btn btn-square btn-success-outline btn-sm me-1');
    }
}

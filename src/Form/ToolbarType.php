<?php

namespace Dannebicque\TableBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire des filtres. setDefaults() rend les options csrf_protection et validation_groups
 * valides même quand les composants security-csrf / validator ne sont pas installés.
 */
class ToolbarType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => false,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
            'label' => false,
            'required' => false,
            'method' => 'GET',
        ]);
    }
}

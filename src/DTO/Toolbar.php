<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/DTO/Toolbar.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 23/10/2021 10:37
 */

namespace Dannebicque\TableBundle\DTO;

use Dannebicque\TableBundle\Widget\DTO\Widget;
use Symfony\Component\Form\FormInterface;

class Toolbar
{
    protected array $formData = [];

    /**
     * Toolbar constructor.
     */
    public function __construct(protected FormInterface $form, protected Widget $widget, protected array $options)
    {
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }

    public function getWidget(): Widget
    {
        return $this->widget;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $name): mixed
    {
        return $this->options[$name];
    }

    public function getFormData(): array
    {
        return $this->formData;
    }

    /**
     * Les valeurs reçues passent par le formulaire : transformation de type et rejet des valeurs invalides.
     */
    public function handleRequest(array $data): self
    {
        if (!$this->form->isSubmitted()) {
            $this->form->submit($data);
        }

        $formData = $this->form->getData();
        $this->formData = array_filter(
            \is_array($formData) ? $formData : [],
            static fn (mixed $value): bool => null !== $value && '' !== $value && [] !== $value,
        );

        return $this;
    }

    public function submitData(array $data): self
    {
        $name = $this->form->getName();

        return $this->handleRequest(\is_array($data[$name] ?? null) ? $data[$name] : []);
    }
}

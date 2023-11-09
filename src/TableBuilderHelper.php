<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/Table/src/TableBuilderHelper.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 14/05/2022 11:04
 */

namespace Dannebicque\TableBundle;

use Dannebicque\TableBundle\Column\ColumnType;
use Dannebicque\TableBundle\DTO\Column;
use Dannebicque\TableBundle\Widget\Type\WidgetType;
use Dannebicque\TableBundle\Widget\WidgetBuilder;
use Dannebicque\TableBundle\Widget\WidgetFactory;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class TableBuilderHelper
{
    /**
     * TableBuilerHelper constructor.
     */
    public function __construct(private readonly TableRegistry $registry, private readonly WidgetFactory $widgetFactory, private readonly FormFactoryInterface $formFactory, private readonly RouterInterface $router)
    {
    }

    public function createWidgetBuilder(string $type = WidgetType::class, array $options = []): WidgetBuilder
    {
        return $this->widgetFactory->createBuilder($type, $options);
    }

    public function createNamedFormBuilder(
        string $name,
        string $type = FormType::class,
        mixed $data = null,
        array $options = []
    ): FormBuilderInterface {
        return $this->formFactory->createNamedBuilder($name, $type, $data, $options);
    }

    public function createColumn(string $name, string $type = ColumnType::class, array $options = []): Column
    {
        $columnType = $this->registry->getColumnType($type);

        $resolver = new OptionsResolver();

        $resolver
            ->setDefault('id', $name)
            ->setDefault('is_safe_html', true);

        $columnType->configureOptions($resolver);
        $columnResolvedOptions = $resolver->resolve($options);

        return new Column($columnType, $columnResolvedOptions);
    }

    public function createAdapter(string $type, array $options = []): array
    {
        $adapterType = $this->registry->getAdapter($type);

        // new Adapter() ....
        $resolver = new OptionsResolver();
        $adapterType->configureOptions($resolver);
        $resolvedAdapterOptions = $resolver->resolve($options);

        return [$adapterType, $resolvedAdapterOptions];
    }

    public function generateUrl(
        string $name,
        array $parameters = [],
        int $referenceType = UrlGeneratorInterface::ABSOLUTE_URL
    ): string {
        $url = $this->router->generate($name, $parameters, $referenceType);

        if (str_starts_with($url, 'https')) {
            return $url;
        }

        return str_replace('http', 'https', $url);
    }
}

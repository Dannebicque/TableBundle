<?php

namespace Dannebicque\TableBundle;

use Dannebicque\TableBundle\Adapter\TableAdapter;
use Dannebicque\TableBundle\Column\ColumnType;
use Dannebicque\TableBundle\DependencyInjection\Compiler\OptionalDoctrinePass;
use Dannebicque\TableBundle\DependencyInjection\Compiler\TableCompilerPass;
use Dannebicque\TableBundle\DependencyInjection\Compiler\WidgetCompilerPass;
use Dannebicque\TableBundle\Widget\Type\WidgetType;
use Dannebicque\TableBundle\Widget\WidgetRegistry;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class DannebicqueTableBundle extends AbstractBundle
{
    protected string $extensionAlias = 'da_table';

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('icons')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('delete')->defaultValue('fas fa-trash')->end()
                        ->scalarNode('edit')->defaultValue('fas fa-edit')->end()
                        ->scalarNode('show')->defaultValue('fas fa-eye')->end()
                        ->scalarNode('duplicate')->defaultValue('fas fa-copy')->end()
                    ->end()
                ->end()
            ->end();
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Rend le contrôleur Stimulus visible d'AssetMapper
        if ($builder->hasExtension('framework') && interface_exists(AssetMapperInterface::class)) {
            $builder->prependExtensionConfig('framework', [
                'asset_mapper' => ['paths' => [$this->getPath().'/assets/dist' => '@dannebicque/table-bundle']],
            ]);
        }
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->parameters()->set('da_table.icons', $config['icons']);
        $container->import('../config/services.php');

        $builder->registerForAutoconfiguration(TableType::class)->addTag(TableRegistry::TAG_TABLE_TYPE);
        $builder->registerForAutoconfiguration(TableAdapter::class)->addTag(TableRegistry::TAG_ADAPTER);
        $builder->registerForAutoconfiguration(ColumnType::class)->addTag(TableRegistry::TAG_COLUMN_TYPE);
        $builder->registerForAutoconfiguration(WidgetType::class)->addTag(WidgetRegistry::TAG_TYPE);
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new OptionalDoctrinePass());
        $container->addCompilerPass(new TableCompilerPass());
        $container->addCompilerPass(new WidgetCompilerPass());
    }
}

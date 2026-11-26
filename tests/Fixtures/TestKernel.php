<?php

namespace Dannebicque\TableBundle\Tests\Fixtures;

use Dannebicque\TableBundle\DannebicqueTableBundle;
use Dannebicque\TableBundle\TableInterface;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\UX\StimulusBundle\StimulusBundle;

class TestKernel extends Kernel
{
    use MicroKernelTrait;

    public function __construct(private readonly bool $doctrine)
    {
        parent::__construct($doctrine ? 'test_orm' : 'test', true);
    }

    public function registerBundles(): iterable
    {
        yield new FrameworkBundle();
        yield new TwigBundle();
        yield new StimulusBundle();
        if ($this->doctrine) {
            yield new DoctrineBundle();
        }
        yield new DannebicqueTableBundle();
    }

    public function getProjectDir(): string
    {
        return sys_get_temp_dir().'/table_bundle_tests/'.Kernel::VERSION;
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        // ni CSRF ni validation : le bundle doit fonctionner sans ces extensions de formulaire
        $container->extension('framework', ['secret' => 'test', 'test' => true, 'csrf_protection' => false, 'validation' => ['enabled' => false]]);
        $container->extension('twig', ['strict_variables' => true]);
        if ($this->doctrine) {
            $container->extension('doctrine', [
                'dbal' => ['url' => 'sqlite:///:memory:'],
                'orm' => ['mappings' => ['Test' => ['type' => 'attribute', 'dir' => __DIR__.'/Entity', 'prefix' => __NAMESPACE__.'\\Entity', 'is_bundle' => false]]],
            ]);
        }
        $services = $container->services()->defaults()->autowire()->autoconfigure();
        $services->set(UserTableType::class);
        $services->set(EntityTableType::class);
        $services->set('logger', \Psr\Log\NullLogger::class);
        $services->alias('test.factory', TableInterface::class)->public();
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->add('users', '/users/{_format}')->defaults(['_format' => 'html']);
    }
}

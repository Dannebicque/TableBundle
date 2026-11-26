<?php

namespace Dannebicque\TableBundle\Tests;

use Dannebicque\TableBundle\Column as C;
use Dannebicque\TableBundle\DTO\Table;
use Dannebicque\TableBundle\Tests\Fixtures\Entity\User;
use Dannebicque\TableBundle\Tests\Fixtures\EntityTableType;
use Dannebicque\TableBundle\Tests\Fixtures\TestKernel;
use Dannebicque\TableBundle\Tests\Fixtures\UserTableType;
use Dannebicque\TableBundle\Widget\Type as W;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TableTest extends TestCase
{
    private ?TestKernel $kernel = null;

    public static function setUpBeforeClass(): void
    {
        (new Filesystem())->remove(sys_get_temp_dir().'/table_bundle_tests');
    }

    protected function tearDown(): void
    {
        $this->kernel?->shutdown();
        restore_exception_handler();
    }

    private function boot(bool $doctrine = false): TestKernel
    {
        $this->kernel = new TestKernel($doctrine);
        $this->kernel->boot();

        return $this->kernel;
    }

    private function table(): Table
    {
        $container = $this->boot()->getContainer();
        $container->get('request_stack')->push(Request::create('/users'));

        return $container->get('test.factory')->createBuilder(UserTableType::class)->setLoadUrl('users')->getTable();
    }

    private static function json(array|string $body): Request
    {
        return Request::create('/users', 'POST', server: ['CONTENT_TYPE' => 'application/json'], content: \is_string($body) ? $body : json_encode($body));
    }

    public function testRender(): void
    {
        $table = $this->table();
        $twig = $this->kernel->getContainer()->get('test.service_container')->get('twig');
        $html = $twig->createTemplate('{{ table_render(table) }}')->render(['table' => $table]);

        self::assertStringContainsString('data-controller="dannebicque--table-bundle--table"', $html);
        self::assertStringContainsString('data-column="name"', $html);
        self::assertStringContainsString('_tbf[search]', $html);
        self::assertStringContainsString('id="eraseFiltre"', $html);
        self::assertStringContainsString('/users/csv', $html);
        self::assertStringContainsString('&quot;url&quot;:&quot;\/users&quot;', $html);
    }

    public function testCallback(): void
    {
        $table = $this->table()->handleRequest(self::json([
            'paging' => ['pageLength' => '60', 'pageActive' => 2],
            'order' => [['column' => 'name', 'order' => 'DESC'], ['column' => 'nope', 'order' => 'ASC'], 'junk'],
            'filter' => ['search' => 'abc', 'unknown' => 'x'],
        ]));

        self::assertTrue($table->isCallback());
        $data = json_decode($table->getCallbackResponse()->getContent(), true);
        $state = UserTableType::$lastState;

        self::assertSame(60, $state->getStart());
        self::assertSame(60, $state->getLength());
        self::assertCount(1, $state->getOrderBy());
        self::assertSame(['search' => 'abc'], $state->getFormData());
        self::assertSame(95, $data['paging']['recordsTotal']);
        self::assertSame(2, $data['paging']['nbPages']);
        self::assertTrue($data['paging']['lastPage']);

        $row = $data['data'][0];
        foreach (['name', 'badge', 'link'] as $column) {
            self::assertStringNotContainsString('<script>', $row[$column]);
            self::assertStringContainsString('&lt;script&gt;', $row[$column]);
        }
        self::assertSame('31/01/2000', $row['born']);
        self::assertStringContainsString('bg-success', $row['active']);
        foreach (['fa-eye', 'fa-edit', 'fa-copy', 'fa-trash', 'data-action="dannebicque--table-bundle--modal#openModal"'] as $expected) {
            self::assertStringContainsString($expected, $row['actions']);
        }
    }

    public function testClientValuesAreBounded(): void
    {
        $table = $this->table()->handleRequest(self::json(['paging' => ['pageLength' => 1000000, 'pageActive' => -5]]));
        $table->getCallbackResponse();

        self::assertSame(30, UserTableType::$lastState->getLength());
        self::assertSame(0, UserTableType::$lastState->getStart());
    }

    public function testOtherRequestsAreIgnored(): void
    {
        $table = $this->table();

        self::assertFalse($table->handleRequest(Request::create('/users'))->isCallback());
        self::assertFalse($table->handleRequest(Request::create('/users', 'POST', ['a' => 'b']))->isCallback());
        $this->expectException(BadRequestHttpException::class);
        $table->handleRequest(self::json('{oops'));
    }

    public function testHandleParameters(): void
    {
        $table = $this->table();
        $table->handleParamaters([$table->getId().'_tbf' => ['search' => 'abc']]);

        self::assertSame(['search' => 'abc'], $table->getState()->getFormData());
        self::assertSame(30, $table->getState()->getLength());
    }

    public function testEntityAdapter(): void
    {
        $container = $this->boot(true)->getContainer();
        $services = $container->get('test.service_container');
        $em = $services->get('doctrine.orm.entity_manager');
        (new SchemaTool($em))->createSchema([$em->getClassMetadata(User::class)]);
        foreach (['alice', 'bob', 'bill'] as $name) {
            $user = new User();
            $user->name = $name;
            $em->persist($user);
        }
        $em->flush();

        $table = $container->get('test.factory')->create(EntityTableType::class);
        $table->handleRequest(self::json(['filter' => ['search' => 'b'], 'order' => [['column' => 'name', 'order' => 'ASC']]]));
        $data = json_decode($table->getCallbackResponse()->getContent(), true);

        self::assertSame(['bill', 'bob'], array_column($data['data'], 'name'));
        self::assertSame(2, $data['paging']['recordsTotal']);
    }

    public function testRemainingTypes(): void
    {
        $container = $this->boot(true)->getContainer();
        $container->get('request_stack')->push(Request::create('/users'));
        $services = $container->get('test.service_container');
        $em = $services->get('doctrine.orm.entity_manager');
        (new SchemaTool($em))->createSchema([$em->getClassMetadata(User::class)]);
        $user = new User();
        $user->name = '<b>';
        $em->persist($user);
        $em->flush();

        $row = ['owner' => $user, 'tags' => ['<i>'], 'score' => 5, 'details' => '"quoted"', 'pick' => null];
        $builder = $container->get('test.factory')->createBuilder(EntityTableType::class);
        $table = $builder
            ->addColumn('owner', C\EntityColumnType::class, ['property_path' => '[owner]', 'display_field' => 'name'])
            ->addColumn('tags', C\ManyColumnType::class, ['many_path' => '[tags]'])
            ->addColumn('score', C\BadgeSeuilColumnType::class, ['property_path' => '[score]'])
            ->addColumn('details', C\DetailsHandleColumnType::class, ['render_details' => fn (array $r) => $r['details']])
            ->addColumn('pick', C\SelectColumnType::class, ['property_path' => '[pick]', 'entity' => User::class, 'choice_label' => 'name', 'choices' => null])
            ->addWidget('choose', W\SelectChangeType::class, ['route' => 'users', 'choices' => ['Un' => 1]])
            ->addWidget('entity', W\SelectChangeType::class, ['route' => 'users', 'entity' => User::class, 'choice_label' => 'name', 'choices' => null])
            ->getTable();

        $columns = $table->getColumns();
        self::assertSame('<b>', html_entity_decode($columns['owner']->render($row)));
        self::assertStringNotContainsString('<b>', $columns['owner']->render($row));
        self::assertStringContainsString('&lt;i&gt;</span>', $columns['tags']->render($row));
        self::assertStringContainsString('bg-success">5</span>', $columns['score']->render($row));
        self::assertStringContainsString('&quot;quoted&quot;', $columns['details']->render($row));
        self::assertStringContainsString('&lt;b&gt;</option>', $columns['pick']->render($row));

        $html = $services->get('twig')->createTemplate('{{ filters_render(table.toolbar) }}')->render(['table' => $table]);
        self::assertStringContainsString('<option value="1" >Un</option>', preg_replace('/\s+>Un/', ' >Un', $html));
        self::assertStringContainsString('&lt;b&gt;</option>', $html);
    }

    public function testActionsAndTranslations(): void
    {
        $table = $this->table()->handleRequest(self::json([]));
        $actions = json_decode($table->getCallbackResponse()->getContent(), true)['data'][0]['actions'];

        self::assertStringContainsString('data-method="DELETE"', $actions);
        self::assertStringContainsString('data-confirm="Confirm deletion?"', $actions);
        self::assertStringContainsString('title="Edit"', $actions);
        self::assertStringContainsString('data-controller="dannebicque--table-bundle--modal"', $actions);
        // CSRF désactivé dans ce noyau : pas de jeton
        self::assertStringNotContainsString('data-token', $actions);

        $services = $this->kernel->getContainer()->get('test.service_container');
        $services->get('translator')->setLocale('fr');
        $html = $services->get('twig')->createTemplate('{{ table_render(table) }}')->render(['table' => $table]);

        self::assertStringContainsString('Pas de donn', $html);
        self::assertStringContainsString('title="Supprimer les filtres"', $html);
        self::assertStringContainsString('data-close-label="Fermer"', $html);
    }

    public function testSelectColumnLiveUpdate(): void
    {
        $container = $this->boot(true)->getContainer();
        $container->get('request_stack')->push(Request::create('/users'));
        $table = $container->get('test.factory')->createBuilder(EntityTableType::class)
            ->addColumn('pick', C\SelectColumnType::class, [
                'property_path' => '[pick]',
                'choices' => ['Un' => 1],
                'live_update' => true,
                'live_update_path' => 'users',
                'live_update_params' => static fn (array $row): array => ['id' => $row['id']],
            ])
            ->addColumn('check', C\CheckBoxColumnType::class)
            ->getTable();

        $row = ['id' => 7, 'pick' => null];
        $select = $table->getColumn('pick')->render($row);

        self::assertStringContainsString('data-route="/users"', $select);
        self::assertStringContainsString('data-params="{&quot;id&quot;:7}"', $select);
        self::assertStringContainsString('value="7"', $table->getColumn('check')->render($row));
    }
}

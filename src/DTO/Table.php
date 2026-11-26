<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/DTO/Table.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 19:11
 */

namespace Dannebicque\TableBundle\DTO;

use Dannebicque\TableBundle\Adapter\DoctrineAdapterInterface;
use Dannebicque\TableBundle\Adapter\TableAdapter;
use Doctrine\ORM\QueryBuilder;
use LogicException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Table
{
    final public const SORT_ASCENDING = 'ASC';
    final public const SORT_DESCENDING = 'DESC';

    protected TableState $state;

    protected ?TableResponse $response = null;

    /**
     * DataTable constructor.
     */
    public function __construct(
        protected Toolbar $toolbar,
        protected array $columns,
        protected TableAdapter $adapter,
        protected array $adapterOptions,
        protected array $options,
        protected Paging $paging
    ) {
        $this->state = new TableState($this);
    }

    public function getId(): string
    {
        return $this->options['id'];
    }

    public function setLoadUrl(string $url): self
    {
        $this->options['load_url'] = $url;

        return $this;
    }

    public function getToolbar(): Toolbar
    {
        return $this->toolbar;
    }

    /**
     * @return array|Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getColumn(string $name): Column
    {
        return $this->columns[$name];
    }

    public function hasColumn(string $name): bool
    {
        return isset($this->columns[$name]);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $name): mixed
    {
        return $this->options[$name];
    }

    public function getState(): TableState
    {
        return $this->state;
    }

    public function handleRequest(Request $httpRequest): self
    {
        $this->response = null;
        $this->state = new TableState($this);

        // Seul un POST JSON est un appel du tableau : les autres formulaires de la page sont ignorés.
        if (!$httpRequest->isMethod('POST') || 'json' !== $httpRequest->getContentTypeFormat()) {
            return $this;
        }

        try {
            $parameters = json_decode($httpRequest->getContent() ?: '[]', true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new BadRequestHttpException('Invalid JSON body.', $e);
        }

        if (!\is_array($parameters)) {
            throw new BadRequestHttpException('Invalid JSON body.');
        }

        if (\is_array($parameters['paging'] ?? null)) {
            $this->paging->handleRequest($parameters['paging']);
        }

        if (\is_array($parameters['filter'] ?? null)) {
            $this->toolbar->handleRequest($parameters['filter']);
        }

        $this->state->setPaging($this->paging->getData());
        $this->state->setFormData($this->toolbar->getFormData());
        $this->state->applyParameters($parameters);

        return $this;
    }

    /**
     * @deprecated since 2.0, use handleParameters()
     */
    public function handleParamaters(array $parameters): self
    {
        trigger_deprecation('dannebicque/table-bundle', '2.0', 'The "%s()" method is deprecated, use "handleParameters()" instead.', __METHOD__);

        return $this->handleParameters($parameters);
    }

    public function handleParameters(array $parameters): self
    {
        $this->response = null;

        $this->state = new TableState($this);
        $this->toolbar->submitData($parameters);
        $this->state->setPaging($this->paging->getData());
        $this->state->setFormData($this->toolbar->getFormData());
        $this->state->applyParameters($parameters);

        return $this;
    }

    public function getCallbackResponse(): TableResponse
    {
        if (!$this->isCallback()) {
            throw new RuntimeException('Unable to get callback response, request is not valid');
        }

        if (null !== $this->response) {
            return $this->response;
        }

        $result = $this->getAdapterResult();

        // Create Row Views
        $rowViews = [];
        foreach ($result->getData() as $object) {
            $view = new RowView();
            foreach ($this->columns as $column) {
                $view->data[$column->getOption('id')] = $column->render($object);
            }

            $rowViews[] = $view;
        }

        $this->paging->setResult($result);

        return $this->response = TableResponse::createSuccess($rowViews, $this->paging->getData());
    }

    public function isCallback(): bool
    {
        return $this->state->isCallback();
    }

    // Adapter helper

    /**
     * @throws \Dannebicque\TableBundle\Adapter\AdapterException
     */
    public function getAdapterResult(): TableResult
    {
        return $this->adapter->getResult($this->state, $this->adapterOptions);
    }

    public function getAdapterQueryBuilder(): QueryBuilder
    {
        if ($this->adapter instanceof DoctrineAdapterInterface) {
            return $this->adapter->getQueryBuilder($this->state, $this->adapterOptions);
        }

        throw new LogicException('You must use a DoctrineAdapter if you want to retrieve a query builder.');
    }
}

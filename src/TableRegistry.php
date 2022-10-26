<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/Table/src/TableRegistry.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 14/05/2022 11:04
 */

namespace DavidAnnebicque\TableBundle;

use DavidAnnebicque\TableBundle\Adapter\TableAdapter;
use DavidAnnebicque\TableBundle\Column\ColumnType;
use InvalidArgumentException;

/**
 * Registry used for Columns / adapter and DataTableType.
 */
class TableRegistry
{
    final public const TAG_TABLE_TYPE = 'da_table.type';
    final public const TAG_COLUMN_TYPE = 'da_table.columntype';
    final public const TAG_ADAPTER = 'da_table.adapter';

    /**
     * @var TableType[]
     */
    protected array $types = [];

    /**
     * @var ColumnType[]
     */
    protected array $columnTypes = [];

    /**
     * @var TableAdapter[]
     */
    protected array $adapters = [];

    // DataTable Type

    public function registerType(string $name, TableType $type): void
    {
        $this->types[$name] = $type;
    }

    public function getType(string $name): TableType
    {
        if (!isset($this->types[$name])) {
            throw new InvalidArgumentException(sprintf('Table "%s" doesn\'t exist, maybe you have forget to register it ?', $name));
        }

        return $this->types[$name];
    }

    // Column Type

    public function registerColumnType(string $name, ColumnType $columnType): void
    {
        $this->columnTypes[$name] = $columnType;
    }

    public function getColumnType(string $name): ColumnType
    {
        if (!isset($this->columnTypes[$name])) {
            throw new InvalidArgumentException(sprintf('Column "%s" doesn\'t exist, maybe you have forget to register it ?', $name));
        }

        return $this->columnTypes[$name];
    }

    // Adaptater (type)

    public function registerAdapter(string $name, TableAdapter $adapter): void
    {
        $this->adapters[$name] = $adapter;
    }

    public function getAdapter(string $name): TableAdapter
    {
        if (!isset($this->adapters[$name])) {
            throw new InvalidArgumentException(sprintf('Adapter "%s" doesn\'t exist, maybe you have forget to register it ?', $name));
        }

        return $this->adapters[$name];
    }
}

<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/Table/src/TableFactory.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 14/05/2022 11:04
 */

namespace DavidAnnebicque\TableBundle;

use DavidAnnebicque\TableBundle\DTO\Table;

class TableFactory implements TableInterface
{
    /**
     * DataTableFactory constructor.
     */
    public function __construct(protected TableRegistry $registry, protected TableBuilderHelper $helper)
    {
    }

    public function create(string $type, array $options = []): Table
    {
        return $this->createBuilder($type, $options)->getTable();
    }

    public function createBuilder(string $type, array $options = []): TableBuilder
    {
        return new TableBuilder($this->helper, $this->registry->getType($type), $options);
    }
}

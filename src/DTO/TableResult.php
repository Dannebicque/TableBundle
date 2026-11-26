<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/DTO/TableResult.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 29/08/2021 12:33
 */

namespace Dannebicque\TableBundle\DTO;

class TableResult
{
    protected int $count; // The count total of data without paging
    protected int $nbResults;

    /**
     * DataTableResult constructor.
     */
    public function __construct(protected iterable $data = [], ?int $count = null)
    {
        if (!is_countable($this->data)) {
            $this->data = iterator_to_array($this->data, false);
        }

        $this->count = $count ?? count($this->data);
        $this->nbResults = $this->count;
    }

    public function getData(): iterable
    {
        return $this->data;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getNbResults(): int
    {
        return $this->nbResults;
    }
}

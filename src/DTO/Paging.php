<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/DTO/Paging.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 26/09/2021 18:48
 */

namespace Dannebicque\TableBundle\DTO;

class Paging
{
    private int $pageLength;
    private int $pageActive;
    private int $recordsTotal = 0;
    private int $recordsFiltered = 0;
    private int $nbPages = 0;

    /** @var int[] tailles de page acceptées depuis le navigateur */
    private array $allowedLengths;

    public function __construct(array $options = [])
    {
        $this->pageLength = max(1, $options['page_length']);
        $this->pageActive = max(1, $options['page_active']);
        $this->allowedLengths = [$this->pageLength, ...array_map('intval', $options['length_menu'] ?? [])];
    }

    public function handleRequest(array $paging): void
    {
        $length = filter_var($paging['pageLength'] ?? null, FILTER_VALIDATE_INT);
        if (false !== $length && \in_array($length, $this->allowedLengths, true)) {
            $this->pageLength = $length;
        }

        $page = filter_var($paging['pageActive'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 1_000_000_000]]);
        if (false !== $page) {
            $this->pageActive = $page;
        }
    }

    public function getData(): array
    {
        return [
            'pageLength' => $this->pageLength,
            'numActivePage' => $this->pageActive,
            'recordsTotal' => $this->recordsTotal,
            'recordsFiltered' => $this->recordsFiltered,
            'firstPage' => 1 === $this->pageActive,
            'lastPage' => $this->pageActive >= $this->nbPages,
            'nbPages' => $this->nbPages,
            'start' => $this->getStart(),
        ];
    }

    private function getStart(): int
    {
        return ($this->pageActive - 1) * $this->pageLength;
    }

    public function setResult(TableResult $tableResult): void
    {
        $this->recordsFiltered = $tableResult->getNbResults();
        $this->recordsTotal = $tableResult->getCount();
        $this->nbPages = (int) ceil($this->recordsFiltered / $this->pageLength);
    }
}

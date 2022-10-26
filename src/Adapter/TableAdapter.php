<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Adapter/TableAdapter.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/08/2021 14:07
 */

namespace DavidAnnebicque\TableBundle\Adapter;

use DavidAnnebicque\TableBundle\DTO\TableResult;
use DavidAnnebicque\TableBundle\DTO\TableState;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class TableAdapter
{
    public function configureOptions(OptionsResolver $resolver): void
    {
    }

    /**
     * @throws AdapterException
     */
    abstract public function getResult(TableState $state, array $options): TableResult;
}

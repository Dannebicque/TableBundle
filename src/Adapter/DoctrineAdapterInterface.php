<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Adapter/DoctrineAdapterInterface.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/08/2021 14:07
 */

namespace DA\TableBundle\Adapter;

use DA\TableBundle\DTO\TableState;
use Doctrine\ORM\QueryBuilder;

interface DoctrineAdapterInterface
{
    public function getQueryBuilder(TableState $state, array $options): QueryBuilder;
}

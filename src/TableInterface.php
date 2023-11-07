<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/bundles/Table/src/TableBuilder.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 21/10/2022 15:39
 */

namespace DavidAnnebicque\TableBundle;

use DavidAnnebicque\TableBundle\DTO\Table;

interface TableInterface
{
    public function create(string $type, array $options = []): Table;

    public function createBuilder(string $type, array $options = []): TableBuilder;
}

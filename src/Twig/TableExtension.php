<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Table/Twig/TableExtension.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/08/2021 14:49
 */

namespace DA\TableBundle\Twig;

use DA\TableBundle\TableRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TableExtension extends AbstractExtension
{
    /**
     * DataTableTwigExtension constructor.
     */
    public function __construct(protected TableRenderer $renderer)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('table_render', [$this->renderer, 'render'], [
                'is_safe' => ['html'],
            ]),
            new TwigFunction('fitlers_render', [$this->renderer, 'renderToolbar'], [
                'is_safe' => ['html'],
            ]),
            new TwigFunction('action_render', [$this->renderer, 'renderAction'], [
                'is_safe' => ['html'],
            ]),
        ];
    }
}

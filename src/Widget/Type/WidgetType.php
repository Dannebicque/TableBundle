<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Components/Widget/Type/WidgetType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 21/10/2022 12:10
 */

namespace DavidAnnebicque\TableBundle\Widget\Type;

use DavidAnnebicque\TableBundle\Widget\DTO\WidgetView;
use DavidAnnebicque\TableBundle\Widget\WidgetBuilder;
use function array_filter;
use function array_map;
use function is_string;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WidgetType
{
    public function buildView(WidgetView $view, array $options): void
    {
        $view->vars['attr'] = $options['attr'];
        if ($options['class']) {
            if (isset($view->vars['attr']['class'])) {
                $view->vars['attr']['class'] .= ' '.$options['class'];
            } else {
                $view->vars['attr']['class'] = $options['class'];
            }
        } else {
            $view->vars['attr']['class'] = false;
        }

        $view->vars['text'] = $options['text'];
        $view->vars['translation_domain'] = $options['translation_domain'];
        $view->vars['icon'] = $options['icon'];
        $view->vars['icon_only'] = $options['icon_only'];

        if (!empty($options['title'])) {
            $view->vars['attr']['title'] = $options['title'];
//            $view->vars['attr']['data-controller'] = 'interface--tooltip';
//            $view->vars['attr']['data-tooltip-placement'] = $options['placement'];
            //todo: a remettre car en conflit avec modal
        }
    }

    public function buildWidget(WidgetBuilder $builder, array $options): void
    {
    }

    public function getBlockPrefix(): string
    {
        return 'base';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $normalizer = static function (Options $options, $value) {
            if (null === $value) {
                return null;
            }

            if (is_string($value)) {
                return trim($value);
            }

            $a = array_filter(array_map('trim', $value));

            return count($a) > 0 ? implode(' ', $a) : null;
        };

        $resolver
            ->define('title')
            ->default(null)
            ->allowedTypes('string', 'null');

        $resolver
            ->define('placement')
            ->default('bottom')
            ->allowedTypes('string', 'null');

        $resolver
            ->define('class')
            ->default('text-end')//todo: pas idéal, mais semble se perdre en route :D
            ->allowedTypes('string', 'null');

        $resolver
            ->define('icon')
            ->default(null)
            ->allowedTypes('string', 'null');

        $resolver
            ->define('icon_only')
            ->default(false)
            ->allowedTypes('boolean', 'null');

        $resolver
            ->define('attr')
            ->default([])
            ->allowedTypes('array');

        $resolver
            ->define('text')
            ->default(false)
            ->allowedTypes('string', 'null', 'bool');

        $resolver
            ->define('translation_domain')
            ->default(null)
            ->allowedTypes('string', 'null', 'bool');
    }
}

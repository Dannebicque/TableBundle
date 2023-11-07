<?php

namespace DavidAnnebicque\TableBundle\Utils;

abstract class HtmlUtils
{
    public static function type_class_to_id(string $typeClass): string
    {
        $ns = preg_replace('/Type$/', '', $typeClass);
        $name = str_replace('\\', '_', $ns);

        return function_exists('mb_strtolower') && preg_match('//u', $name) ? mb_strtolower($name,
            'UTF-8') : strtolower($name);
    }

    public static function humanize(string $text): string
    {
        return ucfirst(strtolower(trim(preg_replace(['/([A-Z])/', '/[_\s]+/'], ['_$1', ' '], $text))));
    }

    public static function to_attr(array $attributes): string
    {
        $html = '';
        foreach ($attributes as $key => $value) {
            $html .= sprintf('%s="%s" ', $key, htmlspecialchars($value));
        }

        return $html;
    }
}

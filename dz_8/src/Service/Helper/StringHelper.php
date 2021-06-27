<?php

namespace App\Service\Helper;

class StringHelper
{
    public static function snakeCaseToCamelCase(string $expression): string
    {
        return str_replace('_', '', lcfirst(ucwords(mb_strtolower($expression), '_')));
    }

    public static function camelCaseToConstantCase(string $expression): ?string
    {
        return mb_strtoupper(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $expression));
    }

    public static function kebabCaseToPascalCase(string $expression): string
    {
        return str_replace('-', '', ucwords($expression, '-'));
    }

    public static function shrinkWhitespaces(?string $input, string $replacement = ' '): string
    {
        //replace all whitespaces with replacement (defaults to one space)
        return mb_eregi_replace('\s+', $replacement, $input);
    }

    public static function removeEmoji(string $input): ?string
    {
        return preg_replace(
            '/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}]'.
            '[\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}]'.
            '[\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}]'.
            '[\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $input);
    }
}
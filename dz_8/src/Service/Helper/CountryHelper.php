<?php


namespace App\Service\Helper;


class CountryHelper
{

    private const ALPHA2_NAME_MAP = [
        'HR' => 'Croatia',
        'DE' => 'Germany',
    ];

    public static function getName(?string $alpha2):?string
    {
        return self::ALPHA2_NAME_MAP[$alpha2] ?? null;
    }

}

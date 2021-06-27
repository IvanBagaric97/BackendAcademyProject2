<?php


namespace App\Service\Helper;


class MatchHelper
{
    private const STATUS_MAP = [
        'not_started' => 0,
        'halftime1' => 1,
        'halftime2' => 2,
        'pause' => 3,
        'quarter1' => 4,
        'quarter2' => 5,
        'quarter3' => 6,
        'quarter4' => 7,
        'canceled' => 8,
        'finished' => 9,
        'overtime' => 10,
    ];

    public static function getStatus(?string $status):int
    {
        return self::STATUS_MAP[$status];
    }
}
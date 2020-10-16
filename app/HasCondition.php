<?php

namespace App;

trait HasCondition
{
    protected static $conditions = [
        'Sealed',
        'Sealed - Damaged Package',

        'Open',
        'Open - Damaged Package',

        'With Tags',
        'Without Tags',

        'Used',
        'Used Damaged Package / Missing Package',
    ];

    public static function getConditions()
    {
        return static::$conditions;
    }
}

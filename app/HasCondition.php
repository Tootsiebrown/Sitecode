<?php

namespace App;

trait HasCondition
{
    protected static $conditions = [
        'Sealed - New',
        'Sealed - Damaged Package',

        'Open - New',
        'Open - Damaged or no Package',

        'New with tags',
        'New without tags',

        'Used',
        'Used - Damaged or no Package',
    ];

    public static function getConditions()
    {
        return static::$conditions;
    }
}

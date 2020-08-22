<?php

namespace App;

trait HasCondition
{
    protected static $conditions = [
        'Sealed, Unopened',
        'Sealed, Damaged Package',
        'Opened, Unused',
        'Used',
    ];

    public static function getConditions()
    {
        return static::$conditions;
    }
}

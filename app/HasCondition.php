<?php

namespace App;

trait HasCondition
{
    protected static $ebayConditionsMap = [
        'Sealed' => 2750,
        'Sealed - Damaged Package' => 3000,

        'Open' => 3000,
        'Open - Damaged Package' => 4000,

        'With Tags' => 3000,
        'Without Tags' => 5000,

        'Used' => 5000,
        'Used Damaged Package / Missing Package' => 6000,

        'Varied' => 6000,
    ];

    protected static $conditions = [
        'Sealed',
        'Sealed - Damaged Package',

        'Open',
        'Open - Damaged Package',

        'With Tags',
        'Without Tags',

        'Used',
        'Used Damaged Package / Missing Package',

        'Varied',
    ];

    public static function getConditions()
    {
        return static::$conditions;
    }

    public function getEbayConditionIdAttribute()
    {
        return $this->condition ? static::$ebayConditionsMap[$this->condition] : null;
    }
}

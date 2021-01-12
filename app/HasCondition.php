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

        'Varied',
    ];

    public static function getConditions()
    {
        return static::$conditions;
    }

    public function getEbayConditionEnumAttribute()
    {
        $map = [
            1000 => 'NEW',
            1500 => 'NEW_OTHER',
            1750 => 'NEW_WITH_DEFECTS',
            2000 => 'MANUFACTURER_REFURBISHED',
            2500 => 'SELLER_REFURBISHED',
            2750 => 'LIKE_NEW',
            3000 => 'USED_EXCELLENT',
            4000 => 'USED_VERY_GOOD',
            5000 => 'USED_GOOD',
            6000 => 'USED_ACCEPTABLE',
            7000 => 'FOR_PARTS_OR_NOT_WORKING',
        ];

        return $map[$this->ebay_condition_id];
    }
}

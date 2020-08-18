<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class ProductCategory extends Model
{
    protected $guarded = [];

    public function scopeTop($query)
    {
        return $query->where('parent_id', 0);
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function hasChildren()
    {
        return $this->children->count() > 0;
    }
}

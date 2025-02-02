<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;
    protected $guarded = [];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}

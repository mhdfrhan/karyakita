<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFavorites extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}

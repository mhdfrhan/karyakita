<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeatures extends Model
{
    protected $table = 'product_features';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}

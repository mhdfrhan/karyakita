<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    protected $guarded = ['id'];

    public function cart()
    {
        return $this->belongsTo(Carts::class, 'carts_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id');
    }
}

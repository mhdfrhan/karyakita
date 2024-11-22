<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }
}

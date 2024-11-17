<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategories::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function tags()
    {
        return $this->hasMany(ProductTags::class);
    }

    public function features()
    {
        return $this->hasMany(ProductFeatures::class);
    }
}

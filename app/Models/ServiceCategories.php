<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategories extends Model
{
    protected $guarded = ['id'];

    public function serviceCategoriesType()
    {
        return $this->belongsTo(ServiceCategoriesType::class);
    }

    public function serviceSubCategories()
    {
        return $this->hasMany(ServiceSubCategories::class);
    }
}

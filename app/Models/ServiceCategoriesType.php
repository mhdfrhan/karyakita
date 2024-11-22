<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategoriesType extends Model
{
    protected $guarded = ['id'];

    public function serviceCategories()
    {
        return $this->hasMany(ServiceCategories::class);
    }
}

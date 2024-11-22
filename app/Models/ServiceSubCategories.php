<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSubCategories extends Model
{
    protected $guarded = ['id'];

    public function serviceCategories()
    {
        return $this->belongsTo(ServiceCategories::class);
    }
}

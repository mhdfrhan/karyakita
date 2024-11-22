<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }

    public function type()
    {
        return $this->belongsTo(ServiceCategoriesType::class, 'type_id');
    }

    public function sales()
    {
        return $this->hasMany(ServiceOrders::class);
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
        return $this->hasMany(ServiceImages::class);
    }

    public function prices()
    {
        return $this->hasMany(ServicePrice::class);
    }

    public function steps()
    {
        return $this->hasMany(ServiceSteps::class);
    }

    public function servicePay()
    {
        return $this->hasMany(ServicePay::class);   
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePay extends Model
{
    protected $guarded = ['id'];

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}

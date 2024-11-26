<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shops()
    {
        return $this->hasMany(Shops::class);
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function bankAccounts()
    {
        return $this->belongsTo(UserBankAccounts::class, 'user_id');
    }

    public function mutations()
    {
        return $this->hasMany(Mutations::class, 'user_id');
    }

    public function withdrawHistories()
    {
        return $this->hasMany(WithdrawHistory::class, 'user_id');
    }

    public function balance()
    {
        return $this->hasOne(UserBalance::class, 'user_id');
    }
}

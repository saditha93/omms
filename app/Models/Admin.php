<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $guard = "admin";

    protected $fillable = [
        'name',
        'email',
        'mess_id',
        'ahq_estb',
        'password',
        'estb',
        'user_type',
        'active',
        'attempt',
        'attempt_time',
        'suspend',
        'suspend_time',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function establishments()
    {
        return $this->hasOne(Establishments::class,'id','estb');
    }

    public function userTypes()
    {
        return $this->hasOne(UserTypes::class,'id','user_type');
    }

    public function adminMess()
    {
        return $this->hasOne(Mess::class,'id','mess_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function admin()
    {
        return $this->hasMany(Admin::class,'user_type','id');
    }
}

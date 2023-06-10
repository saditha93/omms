<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishments extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [''];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'estb','id');
    }

    public function mess()
    {
        return $this->hasMany(Mess::class,'id','estb');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MessMenuItemCategory extends Model
{
    use HasFactory;
    protected $guarded = [''];
    use SoftDeletes;

    public function messMenuItem()
    {
        return $this->hasMany(MessMenuItem::class,'id','category_id');
    }
}

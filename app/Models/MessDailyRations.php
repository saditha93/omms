<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessDailyRations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];

//    public function messDaiyRationItem()
//    {
//        return $this->hasOne(MessMenu::class,'id','mess_menu_id');
//    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessMenu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'mess_menus';
    protected $guarded = [''];

    public function messDaiyRation()
    {
        return $this->hasMany(MessDailyRations::class,'mess_menu_id','id');
    }
}

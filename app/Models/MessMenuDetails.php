<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessMenuDetails extends Model
{
    use HasFactory;
    protected $table = 'mess_menu_details';
    protected $guarded = [''];
    use SoftDeletes;


    public function messMenu()
    {
        return $this->hasMany(MessMenu::class,'mess_menu_id','id');
    }

}


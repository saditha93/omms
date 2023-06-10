<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPrices extends Model
{
    use HasFactory;
    protected $table = 'mess_menu_item_prices';
    protected $guarded = [''];
    use SoftDeletes;

    public function messMenuItem()
    {
        return $this->hasOne(MessMenuItem::class,'id','item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MessMenuItem extends Model
{
    use HasFactory;
    protected $guarded = [''];
    use SoftDeletes;

    public function messMenuItemCategory()
    {
        return $this->belongsTo(MessMenuItemCategory::class,'category_id','id');
    }

    public function messMenu()
    {
        return $this->hasMany(MessMenu::class,'menu_items','id');
    }

    public function itemPrices()
    {
        return $this->hasOne(ItemPrices::class,'item_id','id');
    }

}

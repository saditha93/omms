<?php

namespace App\Models\Stock;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'active', 'code','measure_unit_id', 'latest_user_tbl_id', 'latest_ip', 'establishment_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'cat_item');
    }

    public function measure_unit()
    {
        return $this->hasOne(MeasureUnit::class, 'id', 'measure_unit_id');
    }

    public function establishment()
    {
        return $this->belongsTo(Mess::class, 'establishment_id', 'id');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'item_id', 'id');
    }
}

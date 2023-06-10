<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRNDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_id', 'item_id', 'qty', 'avl_qty', 'unit_price', 'expire_date', 'manufacture_date', 'active', 'ip', 'creater_id'
    ];

    public function header()
    {
        return $this->belongsTo(GRNHeader::class, 'header_id', 'id');

    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}

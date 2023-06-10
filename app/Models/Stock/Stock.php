<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'qty', 'last_txn_type', 'below_qty', 'shot'
    ];


    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}

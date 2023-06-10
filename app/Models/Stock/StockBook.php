<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'date', 'receive_qty', 'issue_qty', 'quarter', 'balance_qty'
    ];

}

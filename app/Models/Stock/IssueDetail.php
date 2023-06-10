<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_id', 'item_id', 'qty', 'active', 'ip', 'creater_id' , 'unit_price'
    ];

    public function header()
    {
        return $this->belongsTo(IssueHeader::class, 'header_id', 'id');

    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}

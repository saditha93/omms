<?php

namespace App\Models\Stock;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRNHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'no', 'date', 'order_no', 'supplier_id', 'remarks', 'active' , 'establishment_id' ,'is_bar'
    ];

    public function establishment()
    {
        return $this->belongsTo(Mess::class, 'establishment_id', 'id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

}

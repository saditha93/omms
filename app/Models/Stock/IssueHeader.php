<?php

namespace App\Models\Stock;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueHeader extends Model
{
    use HasFactory;


    protected $fillable = [
        'no', 'date', 'service_no', 'creater_id', 'ip', 'active', 'establishment_id', 'order_no','remarks' , 'total'
    ];

    public function establishment()
    {
        return $this->belongsTo(Mess::class, 'establishment_id', 'id');
    }

}

<?php

namespace App\Models\Stock;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'tele', 'mobile', 'active', 'email', 'establishment_id', 'creater_id', 'ip'
    ];

    public function establishment()
    {
        return $this->belongsTo(Mess::class, 'establishment_id', 'id');
    }

}

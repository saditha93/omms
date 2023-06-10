<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mess extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];


    public function establishments()
    {
        return $this->belongsTo(Establishments::class,'estb','id');
    }

    public function messForAdmin()
    {
        return $this->belongsTo(Admin::class,'mess_id','id');
    }

}

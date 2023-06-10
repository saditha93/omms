<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sfhq extends Model
{
    use HasFactory;

    protected $table = 'sfhq';

    protected $fillable = [
        'name'
    ];
}

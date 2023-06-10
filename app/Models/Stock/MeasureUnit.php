<?php

namespace App\Models\Stock;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasureUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'active', 'creater_id', 'ip', 'establishment_id', 'abbreviation', 'size', 'size_type'
    ];

    public function establishment()
    {
        return $this->belongsTo(Mess::class, 'establishment_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'cat_mes');
    }

}

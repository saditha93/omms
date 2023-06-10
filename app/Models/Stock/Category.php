<?php

namespace App\Models\Stock;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'active', 'creater_id', 'ip', 'establishment_id', 'parent_id', 'code' ,'is_bar'
    ];

    public function establishment()
    {
        return $this->belongsTo(Mess::class, 'establishment_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'cat_item');
    }

    public function measure_units()
    {
        return $this->belongsToMany(MeasureUnit::class, 'cat_mes');
    }

}

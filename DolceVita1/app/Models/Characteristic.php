<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonalOrder;

class Characteristic extends Model
{
    use HasFactory;
    protected $table="characteristics";

    public function recipe()
    {
        return $this->belongsToMany(PersonalOrder::class, 'recipe','characteristic_id','personal_order_id')
        ->withPivot('personal_order_id','characteristic_id','value')
        ->withTimestamps();
    }
    public function recipes()
    {
        return $this->belongsToMany(CategoryRecipe::class, 'recipes','characteristic_id','category_recipe_id')
        ->withPivot('category_recipe_id','characteristic_id','value','price')
        ->withTimestamps();
    }
}

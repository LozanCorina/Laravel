<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRecipe extends Model
{
    use HasFactory;
    protected $table="category_recipe";
    public function category_product(){

        return $this->belongsTo(Category::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Characteristic::class, 'recipes','category_recipe_id','characteristic_id')
        ->withPivot('category_recipe_id','characteristic_id','value','price')
        ->withTimestamps();
    }
}

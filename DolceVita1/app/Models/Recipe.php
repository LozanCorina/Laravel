<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table="product_recipe";

    public function category(){

        return $this->belongsTo(Category::class ,'categorie_id');
    }

    // protected $fillable = ['category_id','characteristic_id','value','price'];
    
    // public function personal_recipe(){
    //     return $this->belongsToMany(Recipe::class, 'personal_recipe','recipe_id','user_id')
    //     ->withPivot('id','user_id','recipe_id','qty','weight','price')
    //     ->withTimestamps();
    // }
}

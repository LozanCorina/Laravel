<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table='categories';
    use HasFactory;

    public function products(){

        return $this->hasMany(Product::class,'id_cat','id');
    }

    public function recipe(){

        return $this->hasMany(Recipe::class,'categorie_id');
    }

    public function category_for_recipe(){

        return $this->hasMany(CategoryRecipe::class);
    }
}

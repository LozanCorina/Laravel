<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravelista\Comments\Commentable;
use App\Models\Stock;

class Product extends Model
{
    use SearchableTrait;
    protected $table='products';

    public function categories()
    {
            return $this->belongsTo(Category::class,'id_cat','id');
    }
    public function users()
    {
            return $this->belongsTo(User::class);
    }
    public function user(){
        
        return $this->belongsToMany(User::class, 'cart','product_id','user_id')
        ->withPivot('qty')
        ->withPivot('weight')
        ->withPivot('id')
        ->withPivot('totalprice')
        ->withTimestamps();
    }

    use HasFactory, Commentable;
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.nume' => 10,
            'products.descriere' => 5,
            'products.pret' => 1,           
        ],  
    ];

    public function orders(){
        
        return $this->belongsToMany(Product::class)
        ->withPivot('qty')
        ->withPivot('weight')
        ->withPivot('price')
        ->withPivot('totalprice')
        ->withPivot('created_at')
        ->withPivot('updated_at');
    }

    public function priceFormat(){

       return number_format($this->pret*100/100, 2).' Lei';
    }
  
    public function stock(){
        return $this->hasOne(Stock::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'commentable_id');
    }
}

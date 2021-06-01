<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $fillable = ['name','user_id','email','region','adress','phone','delivery_date', 
    'discount','subtotal','delivery_tax','total_amount','payment_method','payment_status','order_status'];

    public function user(){
        
        return $this->belongsTo(User::class);
    }
    public function products(){
        
        return $this->belongsToMany(Product::class)
        ->withPivot('id')
        ->withPivot('qty')
        ->withPivot('weight')
        ->withPivot('price')
        ->withPivot('totalprice')
        ->withPivot('created_at')
        ->withPivot('updated_at');
    }
    // public function products(){
        
    //     return $this->belongsToMany(Recipe::class)
    //     ->withPivot('id')
    //     ->withPivot('qty')
    //     ->withPivot('weight')
    //     ->withPivot('price')
    //     ->withPivot('created_at')
    //     ->withPivot('updated_at');
    // }
    public function personal_order()
    {
        return $this->belongsToMany(PersonalOrder::class, 'order_personal_product','personal_order_id','order_id')
        ->withPivot('personal_order_id','order_id','qty','weight','price')
        ->withPivot('created_at')
        ->withPivot('updated_at');
    }
}

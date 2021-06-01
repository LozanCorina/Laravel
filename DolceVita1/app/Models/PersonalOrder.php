<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Characteristic;

class PersonalOrder extends Model
{
    use HasFactory;
    protected $table="personal_order";
    protected $fillable =['categorie_id','user_id','qty', 'weight','price','totalprice'];

    public function characteristic()
    {
        return $this->belongsToMany(Characteristic::class, 'recipe','personal_order_id','characteristic_id')
        ->withPivot('personal_order_id','characteristic_id','value')
        ->withPivot('created_at')
        ->withPivot('updated_at');
    }
    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_personal_product','order_id','personal_order_id')
        ->withPivot('personal_order_id','order_id','qty','weight','price')
        ->withPivot('created_at')
        ->withPivot('updated_at');
    }
}

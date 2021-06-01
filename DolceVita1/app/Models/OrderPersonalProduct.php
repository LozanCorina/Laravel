<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPersonalProduct extends Model
{
    use HasFactory;
    protected $table='order_personal_product';
    protected $fillable = ['order_id','personal_order_id','qty','weight','price'];
}

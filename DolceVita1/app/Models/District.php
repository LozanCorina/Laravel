<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class District extends Model
{
    use HasFactory;
    protected $table='districts';
    public function city(){

        return $this->hasMany(City::class);
    }
}

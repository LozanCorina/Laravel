<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class City extends Model
{
    use HasFactory;
    protected $table='cities';

    public function district(){

        return $this->belongsTo(District::class);
    }
}

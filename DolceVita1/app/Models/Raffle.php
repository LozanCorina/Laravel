<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;
    protected $table='raffles';

    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('user_id','raffle_id','photo','status')
        ->withTimestamps();
    }
}

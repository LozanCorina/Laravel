<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Laravelista\Comments\Commenter;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products(){
        
        return $this->belongsToMany(Product::class);
    }
    public function product(){
        
        return $this->belongsToMany(Product::class, 'cart','user_id','product_id')
        ->withPivot('qty')
        ->withPivot('weight')
        ->withPivot('id')
        ->withPivot('price')
        ->withPivot('totalprice')
        ->withTimestamps();
    }
    public function orders(){
        
        return $this->hasMany(Order::class);
    }
    public function personal_order(){
        return $this->belongsToMany(Category::class, 'personal_order','user_id','categorie_id')
        ->withPivot('id','qty','weight','price','ordered','totalprice')
        ->withTimestamps();
    }
    public function personal_recipe(){
        return $this->belongsToMany(Recipe::class, 'personal_recipe','user_id','recipe_id')
        ->withPivot('id','user_id','recipe_id','qty','weight','price')
        ->withTimestamps();
    }

    public function raffles() 
    {
        return $this->belongsToMany(User::class)
        ->withPivot('user_id','raffle_id','photo','status')
        ->withTimestamps();
    }

}

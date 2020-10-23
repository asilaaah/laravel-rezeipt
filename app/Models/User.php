<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Session\Store;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin' , 'approved_at' , 'role', 'store_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function isManager()
    {
       if ($this->role == 1){
           return true;
       }
        return false;
    }

    
    public function isCashier()
    {
       if ($this->role == 2){
           return true;
       }
        return false;
    }

    public function isAdmin()
    {
        if ($this->admin == 1){
            return true;
        }
        return false;
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}

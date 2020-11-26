<?php

namespace App\Models;

use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Store extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    public $sortable = ['name', 'address', 'phone_num'];

    protected $table = 'stores';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

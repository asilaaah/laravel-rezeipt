<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable, HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id','image','user_id','name','description','price','quantity','minimum_quantity',
    ];

    public $sortable = ['id','category_id','name','description','price', 'quality'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImage()
    {
        // add new product then upload the "no image" image first
        // go to product-list, copy paste the image path of  the "no image" image to here
        
        $imagePath = ($this->image) ? $this->image : 'products/No-Photo-Available.jpg';
        return '/storage/' . $imagePath;
    }
}

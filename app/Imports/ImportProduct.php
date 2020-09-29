<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Product([
            'user_id' => auth()->user()->id,
            'image' => '',
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'quantity' => $row[3],
            'category_id' => Category::where('name', $row[4])->first()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'unique:products,name',
            '0' => function($attribute, $value, $onFailure) {
                $onFailure('The'. $value .'is already exists');
        }];
    }
}

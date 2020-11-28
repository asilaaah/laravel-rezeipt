<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();

        return new Product([
            'user_id' => $user->id,
            'image' => '',
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'quantity' => $row[3],
            'minimum_quantity' => $row[4],
            'category_id' => Category::where('name', $row[5])->first()->id,
            'store_id' => $user->store_id,
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

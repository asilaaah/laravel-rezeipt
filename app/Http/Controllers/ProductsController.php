<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('products.index');
    }


    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        $data = request()->validate([
            'category'=> 'required',
            'name' => 'required',
            'description' => '',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->products()->create([
            'category' => $data['category'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'image' => $imagePath,
            ]);

        return redirect('/p/index');
    }

    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));
    }

    public function update(Product $product, User $user)
    {

        $data = request()->validate([
            'category'=> 'required',
            'name' => 'required',
            'description' => '',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'image',
        ]);
        if (request('image')){
            $imagePath = request('image')->store('profile', 'public');

            $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $product->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/p/index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect('/p/index')
                        ->with('success','Products deleted successfully');
    }
}
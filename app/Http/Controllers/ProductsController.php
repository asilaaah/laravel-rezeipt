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
        $products = Product::all();

        return view('products.index', compact('products'));
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

        $imagePath = request('image')->store('products', 'public');

        $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(900, 900);

        $image->save();

        $imageArray = ['image' => $imagePath];
        
        auth()->user()->products()->create(array_merge(
            $data,
            $imageArray ?? []
    ));

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
            $imagePath = request('image')->store('products', 'public');

            $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(900, 900);

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
  
        return redirect('/p/index')->with('success','Products deleted successfully');
    }
}
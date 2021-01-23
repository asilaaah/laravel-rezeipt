<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');
    }

    public function index()
    {
        $user = Auth::user();
        $products = Product::where('storeId',$user->storeId)->sortable()->simplePaginate(15);

        return view('products.index', compact('products', 'user'));
    }


    public function create()
    {
        $user = Auth::user();
        $categories = Category::where('storeId',$user->storeId)->get();

        return view('products.create', compact('categories'));
    }

    public function store()
    {
        $user= Auth::user();
        $data = request()->validate([
            'category_id' => '',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'image',
            'minimum_quantity'=>'',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('products', 'public');

            $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(900, 900);

            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $storeArray = ['storeId' => $user->storeId];


        auth()->user()->products()->create(array_merge(
            $data,
            $imageArray ?? [],
            $storeArray
        ));

        return redirect('/p/index')->with('success','Product added successfully');

    }

    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));
    }

    public function update(Product $product, User $user)
    {

        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'image',
            'minimum_quantity'=>'',
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

        return redirect('/p/index')->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/p/index')->with('success','Product deleted successfully');
    }

    public function show(Product $product)
    {
        $product = Product::findOrFail($product->id);
        return view('products.show', compact('product'));
    }
}

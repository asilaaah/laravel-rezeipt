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
        $products = Product::where('store_id',$user->store_id)->sortable()->simplePaginate(15);

        return view('products.index', compact('products', 'user'));
    }


    public function create()
    {
        $categories = Category::get();

        return view('products.create', compact('categories'));
    }

    public function store()
    {
        $user= Auth::user();
        $data = request()->validate([
            'category_id' => '',
            'name' => 'required',
            'description' => '',
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

        $storeArray = ['store_id' => $user->store_id];


        auth()->user()->products()->create(array_merge(
            $data,
            $imageArray ?? [],
            $storeArray
        ));

        return redirect('/p/index')->with('success','Products added successfully');

    }

    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));
    }

    public function update(Product $product, User $user)
    {

        $data = request()->validate([
            'name' => 'required',
            'description' => '',
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

        return redirect('/p/index')->with('success','Products updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/p/index')->with('success','Products deleted successfully');
    }

    public function show(Product $product)
    {
        $product = Product::findOrFail($product->id);
        return view('products.show', compact('product'));
    }
}

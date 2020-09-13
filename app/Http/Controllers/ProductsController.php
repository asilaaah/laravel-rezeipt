<?php

namespace App\Http\Controllers;

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

        return redirect('/manager/'. auth()-> user()->id);
    }

}

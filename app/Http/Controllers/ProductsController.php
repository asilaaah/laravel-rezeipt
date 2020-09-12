<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        auth()->user()->products()->create($data);

        dd(request()->all());
    }
}

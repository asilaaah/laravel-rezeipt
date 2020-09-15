<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CashierController extends Controller
{
    public function index()
    {
        $user = FacadesAuth::user();
        $products = Product::all();
        

        if (request()->category) 
        {
            $products = Product::with('category')->whereHas('category', function ($query) {
                $query->where('name', request()->category);
            })->get();
            $categories = Category::all();
        } 
        else {
            $products = Product::all();
            $categories = Category::all();
        }
        
        return view('dashboard.cashier', compact('products', 'user', 'categories'));
    }
}

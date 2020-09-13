<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.cashier', compact('products'));
    }
}

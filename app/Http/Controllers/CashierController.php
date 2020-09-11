<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view ('dashboard.cashier');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user)
    {
        $cashier = $user->where('role', 2)->get();
        
        return view ('cashiers.index', ['cashier'=>$cashier]);
    }
}

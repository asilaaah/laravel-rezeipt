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

    public function edit($id)
    {
        $cashiers = User::find($id);
        return view('cashiers.edit', compact('cashiers'));
    }

    public function update(Request $request, $id)
    {
        if($request->action === 'back') {
            return redirect('/c/index');
        } else {
            $cashier = \App\User::find($id);
            $cashier->name = $request->name;
            $cashier->password = Hash::make($request->password);
            $cashier->role = $request->role;
            $cashier->save();
            return redirect('/c/index');
        }
    }
}

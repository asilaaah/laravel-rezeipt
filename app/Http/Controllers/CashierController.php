<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('approved');
    }

    public function index(User $user)
    {
        $cashier = $user->where('role', 2)->simplePaginate(10);

        return view ('cashiers.index', ['cashier'=>$cashier]);
    }

    public function edit(User $user)
    {

        return view('cashiers.edit', compact('user'));
    }

    public function update(User $user)
    {

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->update($data);

        return redirect('/c/index');
    }

    public function destroy(User $user)
    {
        $user->delete();
  
        return redirect('/c/index')->with('success','Products deleted successfully');
    }


}

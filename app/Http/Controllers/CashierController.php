<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('approved');
    }

    public function index(User $user)
    {
        $user = Auth::user();
        $cashier = $user->where('role', 2)->where('store_id',$user->store_id)->sortable()->simplePaginate(10);

        return view ('cashiers.index', compact('cashier','user'));
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

        return redirect('/c/index')->with('success', "Cashier details updated!");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/c/index')->with('success','Cashier deleted successfully');
    }


}

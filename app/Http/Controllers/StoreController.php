<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Auth;
use Session;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        return view('store.index', compact('stores'));
    }


    public function create()
    {
        return view('store.create');
    }


    public function store()
    {

        $data = request()->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_num' => 'required',
        ]);

        Store::create($data);

        return redirect('/store/index')->with('success','Store added successfully');
    }


    public function edit(Store $store)
    {
        return view('store.edit', compact('store'));
    }


    public function update(Store $store, User $user)
    {

        $data = request()->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_num' => 'required',
        ]);

        $store->update($data);

        return redirect('/store/index')->with('success','Store updated successfully');
    }
}

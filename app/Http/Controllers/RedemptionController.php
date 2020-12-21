<?php

namespace App\Http\Controllers;

use App\Models\Redemption;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Str;

class RedemptionController extends Controller
{
    public function index()
    {
        $user = FacadesAuth::user();
        $redemptions = Redemption::sortable()->paginate(10);

        return view('redemption.index', compact('redemptions', 'user'));
    }


    public function create()
    {
        $stores = Store::get();
        return view('redemption.create',compact('stores'));
    }


    public function store(Redemption $redemption)
    {

        $data = request()->validate([
            'store_id' =>'',
            'name' => 'required',
            'points' => 'required|integer|gt:0',
            'discountAmount' => 'required|lt:100|gt:0',
            'expirationDate' => 'required|date|after:today',
            'discountUnit' => 'required|integer|gt:0'
        ]);

        $redemptionArray = ['couponCode' => Str::random(7)];

        $redemption->create(array_merge(
            $data,
            $redemptionArray
        ));

        return redirect('/redemption/index')->with('success','Redemption reward added successfully');
    }


    public function edit(Redemption $redemption)
    {
        return view('redemption.edit', compact('redemption'));
    }


    public function update(Redemption $redemption, User $user)
    {

        $data = request()->validate([
            'store_id' =>'',
            'name' => 'required',
            'points' => 'required|integer|gt:0',
            'discountAmount' => 'required|lt:100|gt:0',
            'expirationDate' => 'required|date|after:today',
            'discountUnit' => 'required|integer|gt:0'
        ]);

        $redemption->update($data);

        return redirect('/redemption/index')->with('success','Redemption reward updated successfully');
    }

    public function destroy(Redemption $redemption)
    {
        $redemption->delete();

        return redirect('/redemption/index')->with('success','Redemption reward deleted successfully');
    }
}

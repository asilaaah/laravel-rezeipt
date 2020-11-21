<?php

namespace App\Http\Controllers;

use App\Models\Redemption;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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
        return view('redemption.create');
    }


    public function store()
    {

        $data = request()->validate([
            'name' => 'required',
            'description' => '',
            'points' => 'required|integer|gt:0',
            'discountAmount' => 'required|lt:100|gt:0',
            'expirationDate' => 'required|date'
        ]);

        Redemption::create($data);

        return redirect('/redemption/index')->with('success','Redemption reward added successfully');
    }


    public function edit(Redemption $redemption)
    {
        return view('redemption.edit', compact('redemption'));
    }


    public function update(Redemption $redemption, User $user)
    {

        $data = request()->validate([
            'name' => 'required',
            'description' => '',
            'points' => 'required|integer|gt:0',
            'discountAmount' => 'required|lt:100|gt:0',
            'expirationDate' => 'required|date'
        ]);

        $redemption->update($data);

        return redirect('/redemption/index')->with('success','Redemption reward updated successfully');
    }
}

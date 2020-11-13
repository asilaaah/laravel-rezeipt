<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ApprovalController extends Controller
{
    public function index(User $user)
    {
        return view('dashboard.admin', compact('user'));
    }

    public function approveList()
    {
        $id = FacadesAuth::user()->id;
        $users = User::whereNull('approved_at')->sortable()->get();

        return view('users', compact('users', 'id'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['approved_at' => now()]);

        return redirect()->route('admin.users.index')->withMessage('User approved successfully');
    }

    public function approval()
    {
        return view('approval');
    }
}

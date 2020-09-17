<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('approved');
    }

    public function index(User $user)
    {
        return view ('dashboard.manager', compact('user'));
    }
}

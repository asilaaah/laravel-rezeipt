<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $user = Auth::user();
        return view('changePassword', compact('user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function redirectTo()
    {
        $user = auth()->user();
        switch($user->role){
            case 0:
                $this->redirectTo = '/admin';
                return $this->redirectTo;

            case 1:
                $this->redirectTo =  "/manager";
                return $this->redirectTo;
            break;

            case 2:
                $this->redirectTo = "/cashier";
                return $this->redirectTo;
            break;

            default:
            $this->redirectTo = '/login';
            return $this->redirectTo;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect('/profile')->with('success', 'Password changed successfully!');
    }
}

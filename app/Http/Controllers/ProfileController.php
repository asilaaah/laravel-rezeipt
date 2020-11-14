<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Profile $profile, User $user)
    {
        $user = User::findOrFail($user->id);
        $profile = User::findOrFail($user->id);
        return view('profile.index', compact('user', 'profile'));
    }

    public function edit(Profile $profile, User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Profile $profile, User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'phone_number' => '',
            'address' => '',
            'birthday' => '',
            'profile_photo' => 'image'
        ]);

        if (request('profile_photo')){
            $imagePath = request('profile_photo')->store('profile', 'public');

            $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(900, 900);

            $image->save();

            $imageArray = ['profile_photo' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        $details = request()->validate([
            'name' => '',
            'email' => 'email'

        ]);

        auth()->user()->update($details);

        return redirect('/profile/'. $user->id);
    }
}

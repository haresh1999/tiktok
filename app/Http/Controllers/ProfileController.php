<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $v = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:6',
            'confirm_password' => 'nullable|same:password',
            'profile_image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        $user = auth()->user();

        if (isset($v['profile_image'])) {

            deleteImage(auth()->user()->profile_image);

            $user->profile_image = uploadImage($v['profile_image'], 'user_profile_image');
        } else {

            unset($v['profile_image']);
        }

        $user->name = $v['name'];
        $user->email = $v['email'];

        if (isset($v['password'])) {

            $user->password = bcrypt($v['password']);
        }

        $user->save();

        return redirect()->back()->with('profile.success', 'Profile updated successfully.');
    }
}

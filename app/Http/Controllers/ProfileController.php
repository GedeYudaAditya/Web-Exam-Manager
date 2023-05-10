<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $data = [
            'title' => 'Profile',
        ];
        return view('profile.index', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();

        // if password is not empty
        if ($request->password != null) {
            if (auth()->user()->role != 'dosen') {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'nim' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                    'password' => 'required|string|min:8|confirmed',
                ]);
            } else {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                    'password' => 'required|string|min:8|confirmed',
                ]);
            }
        } else {
            if (auth()->user()->role != 'dosen') {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'nim' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                ]);
            } else {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                ]);
            }
        }

        // save the image
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $avatarName);
        } else {
            $avatarName = $user->avatar;
        }

        User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'avatar' => $avatarName,
                'password' => bcrypt($request->password),
            ]);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }
}

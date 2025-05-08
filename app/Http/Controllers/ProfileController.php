<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::with('profile')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
            
            $user->profile()->create([
                'bio' => 'Test bio',
                'birthday' => '1990-01-01',
                'avatar_url' => 'https://via.placeholder.com/150'
            ]);
            
            $user->load('profile');
        }

        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = User::with('profile')->first();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::first();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'birthday' => 'nullable|date',
            'avatar_url' => 'nullable|url|max:255',
        ]);

        $user->update([
            'name' => $validated['name']
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio' => $validated['bio'],
                'birthday' => $validated['birthday'],
                'avatar_url' => $validated['avatar_url'],
            ]
        );

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
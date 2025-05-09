<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = User::with('profile')->first();
        
        if (!$profile) {
            $profile = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
            
            $profile->profile()->create([
                'bio' => 'Test bio',
                'birthday' => '1990-01-01',
                'avatar_url' => 'https://via.placeholder.com/150'
            ]);
            
            $profile->load('profile');
        }

        return view('profiles.show', compact('profile'));
    }

    public function edit()
    {
        $profile = User::with('profile')->first();
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = User::first();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'birthday' => 'nullable|date',
            'avatar_url' => 'nullable|url|max:255',
        ]);

        $profile->update([
            'name' => $validated['name']
        ]);

        $profile->profile()->updateOrCreate(
            ['user_id' => $profile->id],
            [
                'bio' => $validated['bio'],
                'birthday' => $validated['birthday'],
                'avatar_url' => $validated['avatar_url'],
            ]
        );

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
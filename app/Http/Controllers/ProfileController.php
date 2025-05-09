<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $profile = $user->load('profile')->profile;
        return view('profiles.show', compact('user', 'profile'));
    }
    
    public function edit(User $user)
    {
        $user->loadMissing('profile');
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'birthday' => 'nullable|date',
            'avatar' => 'nullable|image|max:2048'
        ]);

        // Cập nhật thông tin user
        $user->update(['name' => $validated['name']]);

        // Xử lý upload avatar
        $avatarUrl = $user->profile->avatar_url ?? null;
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $avatarUrl = Storage::url($path);
        }

        // Cập nhật profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'student_id' => $validated['student_id'],
                'bio' => $validated['bio'],
                'birthday' => $validated['birthday'],
                'avatar_url' => $avatarUrl
            ]
        );

        return redirect()->route('profile.show', $user)
            ->with('success', 'Cập nhật thông tin thành công');
    }
}
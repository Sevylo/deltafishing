<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Inertia\Inertia; 

class UserController extends Controller
{
    /**
     * Menampilkan halaman daftar user.
     */
    public function index()
    {
        $users = User::latest()
                    ->paginate(10)
                    ->through(fn ($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                    ]);

        // Render komponen Vue dan kirim data 'users' ke dalamnya
        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Menampilkan halaman edit user.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]
        ]);
    }

    /**
     * Memperbarui data user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('message', 'User updated successfully');
    }

    /**
     * Menghapus user.
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete admin user');
        }

        $user->delete();

        return redirect()->route('users.index')->with('message', 'User deleted successfully');
    }
}
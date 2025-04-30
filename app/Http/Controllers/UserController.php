<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- Use the default User model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginnom' => 'required',
            'loginmot_de_passe' => 'required'
        ]);

        // Attempt login using the 'users' table fields
        if(auth()->attempt([
            'name' => $incomingFields['loginnom'],
            'password' => $incomingFields['loginmot_de_passe']
        ])) {
            $request->session()->regenerate();
            return redirect('/test2');
        }
        // Optionally, add error handling here
        return back()->withErrors(['loginnom' => 'Invalid credentials.']);
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'nom' => ['required','max:255', Rule::unique('users','name')],
            'email' => ['required','email', Rule::unique('users','email')],
            'mot_de_passe' => ['required', 'min:8','max:255']
        ]);

        // Create user in the 'users' table
        $user = User::create([
            'name' => $incomingFields['nom'],
            'email' => $incomingFields['email'],
            'password' => bcrypt($incomingFields['mot_de_passe']),
        ]);
        auth()->login($user);
        return redirect('/test2');
    }
    public function logout () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/'); // Redirect to /test after logout
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'max:255', \Illuminate\Validation\Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users', 'email')->ignore($user->id)],
            // Add more fields here if needed
        ]);

        $user->update($validated);

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'friend_name' => 'required|string|exists:users,name',
        ]);

        $user = auth()->user();
        $friend = User::where('name', $request->friend_name)->first();

        if ($friend->id == $user->id) {
            return back()->withErrors(['friend_name' => "Vous ne pouvez pas vous ajouter vous-même."]);
        }

        // Vérifie si déjà ami
        if ($user->friends()->where('friend_id', $friend->id)->exists()) {
            return back()->withErrors(['friend_name' => "Cet utilisateur est déjà votre ami."]);
        }

        $user->friends()->attach($friend->id);

        return back()->with('success', 'Ami ajouté avec succès !');
    }
}
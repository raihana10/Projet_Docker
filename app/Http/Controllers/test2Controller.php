<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class test2Controller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('test2', compact('user'));
    }

    public function test2()
    {
        $user = auth()->user();
        $friends = $user->friends()->get(); // Récupère la liste des amis

        // Fetch all debts where the user is either the lender or the borrower
        $debts = \App\Models\PrivateDebt::where('id_from', $user->id)
            ->orWhere('id_to', $user->id)
            ->with(['fromUser', 'toUser']) // assuming you have these relationships
            ->get()
            ->map(function($debt) {
                $debt->id_from_name = $debt->fromUser ? $debt->fromUser->name : '';
                $debt->id_to_name = $debt->toUser ? $debt->toUser->name : '';
                return $debt;
            });

        // Fetch groups as before
        $groups = []; // Remplace par ta logique réelle de récupération des groupes

        return view('test2', [
            'user' => $user,
            'groups' => $groups,
            'debts' => $debts,
            'friends' => $friends, // Ajoute cette ligne pour passer la variable à la vue
        ]);
    }

}

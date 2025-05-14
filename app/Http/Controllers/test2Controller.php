<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class test2Controller extends Controller
{
    public function index()
    {

        $user = auth()->user();

        // Récupérer les emprunts où l'utilisateur est soit prêteur, soit emprunteur
        $debts = \App\Models\PrivateDebt::where('id_from', $user->id)
            ->orWhere('id_to', $user->id)
            ->with(['fromUser', 'toUser']) // Assurez-vous que ces relations existent dans le modèle
            ->get()
            ->map(function ($debt) {
                $debt->id_from_name = $debt->fromUser ? $debt->fromUser->name : '';
                $debt->id_to_name = $debt->toUser ? $debt->toUser->name : '';
                return $debt;
            });

        // Grouper les emprunts par l'autre utilisateur
        $groupedDebts = collect($debts)->groupBy(function ($debt) use ($user) {
            return $debt->id_from == $user->id ? $debt->id_to : $debt->id_from;
        });

        return view('test2', [
            'user' => $user,
            'debts' => $debts,
            'groupedDebts' => $groupedDebts,
        ]);
    }

    public function test2()
    {
        $user = auth()->user();
        $groups = $user->groups; // récupère les groupes liés via la table pivot
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

        // Group debts by the other party
        $groupedDebts = collect($debts)
            ->groupBy(function($debt) use ($user) {
                return $debt->id_from == $user->id ? $debt->id_to : $debt->id_from;
            });

        // Create calendar events from debts
        $calendarEvents = collect($debts)
            ->filter(fn($debt) => !empty($debt->due_date))
            ->map(function($debt) {
                return [
                    'title' => 'Rendre à ' . ($debt->id_to_name ?? $debt->id_to),
                    'start' => $debt->due_date,
                    'message' => "Attention : Il faut rendre l'argent à " . ($debt->id_to_name ?? $debt->id_to) . " ce jour-là !"
                ];
            })
            ->values();

        return view('test2', [
            'user' => $user,
            'groups' => $groups,
            'debts' => $debts,
            'friends' => $friends, // Ajoute cette ligne pour passer la variable à la vue
            'groupedDebts' => $groupedDebts, // Ajoute cette ligne pour passer la variable à la vue
            'calendarEvents' => $calendarEvents, // Ajoute cette ligne pour passer la variable à la vue
        ]);
    }

}


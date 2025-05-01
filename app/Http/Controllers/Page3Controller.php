<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Debt;

class Page3Controller extends Controller
{
    public function Page3(Request $request)
    {
        $user = auth()->user();
        $groups = $user->groups; // Supposant que vous avez une relation groups() dans le modèle User
        
        // Récupérer le groupe sélectionné ou le premier par défaut
        $selectedGroupId = $request->input('group_id', $groups->first()->id ?? null);
        $selectedGroup = Group::find($selectedGroupId);
        
        if (!$selectedGroup) {
            return redirect()->back()->with('error', 'Aucun groupe trouvé');
        }

        $groupUsers = $selectedGroup->users;
        $debts = Debt::where('group_id', $selectedGroupId)->get();

        // Formater les dettes pour l'affichage
        $formattedDebts = [];
        foreach ($debts as $debt) {
            $key = "{$debt->id_from}-{$debt->id_to}";
            $formattedDebts[$key] = $debt;
        }

        return view('test3', [
            'groups' => $groups,
            'selectedGroup' => $selectedGroup,
            'groupUsers' => $groupUsers,
            'debits' => $formattedDebts
        ]);
    }
}
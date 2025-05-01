<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;

class DebtController extends Controller
{
    // Méthode pour créer ou mettre à jour une dette
    public function update(Request $req)
{
    $data = $req->validate([
        'id_from' => 'required|integer',
        'id_to' => 'required|integer',
        'group_id' => 'required|integer',
        'value' => 'required|numeric',
        'name' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    // Reste de votre logique existante mais en incluant group_id dans les requêtes
    $existingDebt = Debt::where([
        'group_id' => $data['group_id'],
        'id_from' => $data['id_from'],
        'id_to' => $data['id_to'],
        'status' => 'unpaid'
    ])->first();

    // Si la valeur saisie est 0 → on marque la dette comme "paid"
    if ($data['value'] == 0) {
        if ($existingDebt) {
            $existingDebt->status = 'paid';
            $existingDebt->save();
            return response()->json(['status' => 'marked-as-paid', 'debt' => $existingDebt]);
        }
        return response()->json(['status' => 'no-debt-found']);
    }

    // Si une dette existe déjà avec statut "paid", on crée une nouvelle dette
    if ($existingDebt && $existingDebt->status === 'paid') {
        $newDebt = Debt::create([
            'id_from'    => $data['id_from'],
            'id_to'      => $data['id_to'],
            'value'      => $data['value'],
            'name'       => $data['name'] ?? '',
            'description'=> $data['description'] ?? '',
            'status'     => 'unpaid',
        ]);
        return response()->json(['status' => 'new-debt-created', 'debt' => $newDebt]);
    }

    // Sinon : mettre à jour ou créer une dette unique
    $debt = Debt::updateOrCreate(
        [
            'group_id' => $data['group_id'],
            'id_from'  => $data['id_from'],
            'id_to'    => $data['id_to'],
        ],
        [
            'value'      => $data['value'],
            'status'     => $data['value'] == 0 ? 'paid' : 'unpaid',
            'name'       => $data['name'] ?? 'Auto-generated', // ✅ ajoute une valeur par défaut
            'description'=> $data['description'] ?? null
        ]
    );

    return response()->json(['status' => 'updated', 'debt' => $debt]);
}

    

}

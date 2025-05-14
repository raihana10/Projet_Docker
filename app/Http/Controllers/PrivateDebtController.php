<?php

namespace App\Http\Controllers;

use App\Models\PrivateDebt;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateDebtController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'id_to_name' => 'required|string|exists:users,name',
            'description' => 'nullable|string',
            'status' => 'required|in:unpaid,paid',
            'due_date' => 'required|date',
        ]);

        $id_to_user = User::where('name', $request->id_to_name)->first();

        if (!$id_to_user) {
            return back()->withErrors(['id_to_name' => "L'utilisateur destinataire n'existe pas."]);
        }

        PrivateDebt::create([
            'name' => $request->name,
            'value' => $request->value,
            'id_from' => auth()->id(),
            'id_to' => $id_to_user->id,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Emprunt ajouté avec succès !');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class debtController extends Controller
{
    public function createDebt(Request $request) {
        $incomingFields = $request->validate([
            'nom' => 'required',
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255'
        ]);

        // Here you would typically save the debt to the database
        // For example:
        // Debt::create($incomingFields);

        return response()->json(['message' => 'Debt created successfully!']);
    }
}

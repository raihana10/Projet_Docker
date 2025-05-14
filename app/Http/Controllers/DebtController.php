<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'due_date' => 'required|date',
        ]);

        Debt::create([
            'due_date' => $validated['due_date'],
        ]);

        $debts = Debt::all();
        foreach ($debts as $debt) {
            if ($debt->due_date && \Carbon\Carbon::parse($debt->due_date)->diffInDays(now(), false) === 1) {
                session()->flash('one_day_left', "Attention : Il reste 1 jour pour rendre l'argent à " . ($debt->toUser->name ?? $debt->id_to));
                break;
            }
        }

        return redirect()->back()->with('success', 'Emprunt ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        //
    }
}

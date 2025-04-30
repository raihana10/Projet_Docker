<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
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
        return view('create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'description' => 'nullable|string',
            'join_code' => 'required|string|unique:groups,join_code',
        ]);

        // Création du groupe avec l'utilisateur connecté comme hôte
        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'join_code' => $request->join_code,
            'host_id' => Auth::id(),
        ]);

        // Ajouter automatiquement le créateur dans le groupe
        $group->users()->attach(Auth::id());

        return redirect()->route('test2')->with('success', 'Groupe créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}

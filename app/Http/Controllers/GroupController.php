<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'join_code' => 'required|string|unique:groups,join_code',
    ]);

    $group = Group::create([
        'name' => $request->name,
        'description' => $request->description,
        'join_code' => $request->join_code,
        'host_id' => auth()->id(), // ✅ ici on ajoute le host_id
    ]);

    // l’utilisateur qui crée rejoint le groupe automatiquement
    $group->users()->attach(auth()->id());
    return redirect()->back()->with('success', 'Groupe créé avec succès.');

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

    public function join(Request $request)
{
    $group = Group::where('join_code', $request->join_code)->first();

    if (!$group) {
        return back()->with('error', 'Code invalide.');
    }

    // Vérifie si l'utilisateur est déjà dans le groupe
    if ($group->users->contains(auth()->id())) {
        return back()->with('message', 'Vous êtes déjà dans ce groupe.');
    }

    $group->users()->attach(auth()->id());

    return back()->with('success', 'Vous avez rejoint le groupe avec succès !');
}

}

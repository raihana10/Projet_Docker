<?php

namespace App\Http\Controllers;

use App\Models\utilisateur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class utilisateurController extends Controller
{

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginnom' => 'required',
            'loginmot_de_passe' => 'required'
        ]);

        if(auth()->attempt([
                'nom' => $incomingFields['loginnom'],
                'mot_de_passe' => $incomingFields['loginmot_de_passe']
                ])) {
            $request->session ()->regenerate();
        }
        return redirect('/');
    }

    public function logout () {
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'nom' => ['required','max:255', Rule::unique('utilisateur','nom')],
            'email' => ['required','email', Rule::unique('utilisateur','email')],
            'mot_de_passe' => ['required', 'min:8','max:255']
        ]);

        $incomingFields['mot_de_passe'] = bcrypt($incomingFields['mot_de_passe']);
        $utilisateur = utilisateur::create($incomingFields);
        auth()->login($utilisateur);
        return redirect('/');
    }
    
}

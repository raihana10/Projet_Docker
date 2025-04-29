<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register( Request $request){
        $incomingFields = $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email'],
            'password' => ['required', 'min:8','max:255']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::create($incomingFields);
        
        return 'Hello from our Controller';
    }
}

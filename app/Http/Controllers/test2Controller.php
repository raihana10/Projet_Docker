<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class test2Controller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('test2', compact('user'));
    }
}

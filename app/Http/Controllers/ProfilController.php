<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class ProfilController extends Controller
{
    public function index(){

        $user = Auth::user();
        
        $data = [
            "user"=> $user,
        ];
        
        return view("home/profil", $data);
    }
}

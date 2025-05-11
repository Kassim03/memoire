<?php

    namespace App\Web\Controllers;

    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    use StormBin\Package\Auth\Auth;
    class PaiementController extends Controller
    {
        public function index()
        {
            $user = Auth::user();
            
            return Views::render("home/Paiement",$user);
        }

        public function paiement()
        {
            echo "ok";
        }
    }

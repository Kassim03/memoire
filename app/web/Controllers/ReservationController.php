<?php

    namespace App\Web\Controllers;

    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    use StormBin\Package\Auth\Auth;
    class ReservationController extends Controller
    {
        public function isConnected()
        {
            if (!Auth::check()) {
                return Views::redirect('/login');
            } else {
                return Views::render("home/reservation");
            }
        }
        


        public function traitement(){
            $user = Auth::user();
            return Views::render("home/Paiement", $user);
        }
    }

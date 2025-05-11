<?php

    namespace App\Web\Controllers;

    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    use StormBin\Package\Auth\Auth;
    class Dashboard extends Controller
    {
        /* public function dashboard()
        {
            //$_SESSION['user_id']=1;
            return Views::render("home/dashboard");
        } */
        public function isConnected()
        {   
            if (!Auth::check()) {
                return Views::redirect('/login'); // Rediriger si l'utilisateur n'est pas connecté
            }
            $user = Auth::user();
            

            #dd($user);
            return Views::render("home/dashboard", $user);
        }
        public function logout()
        {
            Auth::logout();
            // Redirect to the login page or any other page
            return Views::redirect('/login');
        }
    }

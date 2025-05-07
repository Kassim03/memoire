<?php

    namespace App\Web\Controllers;

    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    class LoginController extends Controller
    {
        #Methode servant la page login
        public function index()
        {
            return Views::render("login");
        }
    }

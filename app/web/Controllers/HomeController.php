<?php

    namespace App\Web\Controllers;

    use StormBin\Package\Controllers\Controller;
    use StormBin\Package\Views\Views;
    class HomeController extends Controller
    {
        public function index()
        {
            return Views::render("home/index");
        }
    }

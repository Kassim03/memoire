<?php

    use StormBin\Package\Routes\Route;
    use StormBin\Package\Request\Request;
    use App\Web\Controllers\HomeController;
    use App\Web\Controllers\LoginController;
    use App\Web\Controllers\RegisterController;
    Route::get("/", [HomeController::class,"index"])->name("home");
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::get("/register", [RegisterController::class, "index"])->name("register");

    
<?php

    use App\Web\Controllers\Dashboard;
    use StormBin\Package\Routes\Route;

    use App\Web\Controllers\HomeController;
    use App\Web\Controllers\LoginController;
    use App\Web\Controllers\RegisterController;
    use App\Web\Controllers\ReservationController;
    use App\Web\Controllers\PaiementController;
    use StormBin\Package\MiddleWare\AuthMiddleware;
    
    Route::get("/", [HomeController::class,"index"])->name("home");
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::get("/register", [RegisterController::class, "index"])->name("register");
    Route::post("/register/post", [RegisterController::class,"register"])->name("register.post");
    Route::post("/login/post", [LoginController::class,"login"])->name("login.post");
    
    //Route::get("/dashboard", [Dashboard::class,"dashboard"])->name("dashboard");
    Route::get('/dashboard', [Dashboard::class, 'isConnected'])
    ->name('dashboard')
    ->middleware('/dashboard', AuthMiddleware::class);
    /* Route::group(['middleware' => AuthMiddleware::class], function () {
        
    }) */;

    Route::beforeMiddleware(['/reservation', '/valider', '/paiement', '/paiement/post'], [ReservationController::class, 'isConnected']);

    Route::get("/reservation", [ReservationController::class, "isConnected"])
    ->name("reservation");
    Route::post("/valider", [ReservationController::class, "traitement"])
    ->name("reservation.post");

    Route::get("/paiement", [PaiementController::class,"index"])
    ->name("paiement");
    Route::post("/paiement/post", [PaiementController::class,"paiement"])
    ->name("paiement.post");
    
    Route::get("/logout",  [Dashboard::class,"logout"])->name("logout");
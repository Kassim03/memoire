<?php

use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;
use StormBin\Package\Routes\Route;
use StormBin\Package\MiddleWare\SessionMiddleware;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/helpers/helpers.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../bootstrap/app.php';

// Enregistre le service "session"
$app->bind('session', function ($app) {
    return new SessionManager($app);
});

// Enregistre le service "session.store"
$app->bind('session.store', function ($app) {
    return $app['session']->driver();
});

// Configurer la facade Session
Illuminate\Support\Facades\Session::setFacadeApplication($app);

// Démarrer la session
$sessionManager = $app['session'];
$session = $sessionManager->driver('file');
$app->instance('session', $session);
$app->instance('session.store', $session);

// Démarrer la session
$sessionManager->start();

// Démarrer le middleware de session
SessionMiddleware::start();

// Lancer les routes
Route::dispatch();
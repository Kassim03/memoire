<?php

use Illuminate\Config\Repository as Config;
use Illuminate\Log\LogManager;
use Illuminate\Routing\Router;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Session\SessionManager;
use Illuminate\Filesystem\Filesystem;

// Inclut la classe CustomContainer
require __DIR__ . '/CustomContainer.php';

// Crée une instance du conteneur personnalisé
$app = new CustomContainer();

// Enregistre le service "events"
$app->bind('events', function () {
    return new Dispatcher();
});

// Enregistre le service "config"
$app->bind('config', function () {
    return new Config([
        'logging' => [
            'default' => 'single',
            'channels' => [
                'single' => [
                    'driver' => 'single',
                    'path' => __DIR__ . '/../storage/logs/storm.log',
                    'level' => 'debug',
                ],
            ],
        ],
        'session' => [
            'driver' => 'file',
            'lifetime' => 120,
            'expire_on_close' => false,
            'encrypt' => false,
            'files' => __DIR__ . '/../storage/framework/sessions',
            'cookie' => 'storm_session',
            'path' => '/',
            'domain' => null,
            'secure' => false,
            'http_only' => true,
            'same_site' => 'lax',
        ],
    ]);
});

// Enregistre le service "log"
$app->bind('log', function ($app) {
    return new LogManager($app);
});

// Enregistre le service "router"
$app->bind('router', function ($app) {
    $router = new Router($app['events'], $app);
    require __DIR__ . '/../routes/web.php';
    return $router;
});

// Enregistre le service "request"
$app->bind('request', function () {
    return Request::capture();
});

// Enregistre le service "redirect"
$app->bind('redirect', function ($app) {
    return new \Illuminate\Routing\Redirector(
        new \Illuminate\Routing\UrlGenerator($app['router']->getRoutes(), $app['request'])
    );
});

// Enregistre le service "jsonResponse"
$app->bind('jsonResponse', function ($app, $parameters) {
    return new JsonResponse(
        $parameters['data'],
        $parameters['status'] ?? 200,
        $parameters['headers'] ?? [],
        $parameters['options'] ?? 0
    );
});

// Enregistre le service "session"
$app->bind('session', function ($app) {
    return new SessionManager($app);
});

// Enregistre le service "session.store"
$app->bind('session.store', function ($app) {
    return $app['session']->driver();
});

// Enregistre le service "filesystem"
$app->singleton('files', function () {
    return new Filesystem();
});

// Enregistre le conteneur dans les facades
Illuminate\Support\Facades\Redirect::setFacadeApplication($app);
Illuminate\Support\Facades\Log::setFacadeApplication($app);
Illuminate\Support\Facades\Config::setFacadeApplication($app);
Illuminate\Support\Facades\Event::setFacadeApplication($app);
Illuminate\Support\Facades\Session::setFacadeApplication($app);

// Crée des alias pour les facades
class_alias(Illuminate\Support\Facades\Redirect::class, 'Redirect');
class_alias(Illuminate\Support\Facades\Log::class, 'Log');
class_alias(Illuminate\Support\Facades\Config::class, 'Config');
class_alias(Illuminate\Support\Facades\Event::class, 'Event');
class_alias(Illuminate\Support\Facades\Session::class, 'Session');

// Démarrer la session
$sessionManager = $app['session'];
$sessionManager->start();

return $app;
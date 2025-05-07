<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | Ce paramètre contrôle le "driver" de session utilisé par ton application.
    | Les options disponibles incluent "file", "cookie", "database", "redis", etc.
    |
    */

    'driver' => 'file',

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | La durée de vie de la session en minutes.
    | Si tu souhaites que la session expire lors de la fermeture du navigateur, 
    | définis "expire_on_close" à true.
    |
    */

    'lifetime' => 120,
    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | Active ou désactive le chiffrement des données de session.
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | Chemin où les sessions sont stockées lorsque tu utilises le driver "file".
    |
    */

    'files' => realpath(__DIR__ . '/../storage/framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Le nom du cookie de session.
    |
    */

    'cookie' => 'storm_session',

    /*
    |--------------------------------------------------------------------------
    | Session Path
    |--------------------------------------------------------------------------
    |
    | Le chemin où le cookie de session sera disponible.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Session Domain
    |--------------------------------------------------------------------------
    |
    | Le domaine associé au cookie.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only
    |--------------------------------------------------------------------------
    |
    | Forcer l'utilisation du cookie uniquement via HTTPS.
    |
    */

    'secure' => false,

    /*
    |--------------------------------------------------------------------------
    | HTTP Access Only
    |--------------------------------------------------------------------------
    |
    | Empêche l'accès au cookie via JavaScript.
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookie
    |--------------------------------------------------------------------------
    |
    | Options : 'lax', 'strict', 'none'.
    |
    */

    'same_site' => 'lax',
];

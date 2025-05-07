<?php

use StormBin\Package\Routes\Route;

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('route')) {
    /**
     * Génère une URL pour une route nommée.
     *
     * @param string $name Nom de la route.
     * @param array $params Paramètres de la route.
     * @return string URL générée.
     */
    if (!function_exists('route')) {
        function route(string $name, $parameters = [], bool $absolute = true): string {
            // Convertit les paramètres en tableau si nécessaire
            $params = is_array($parameters) ? $parameters : ['id' => $parameters];
            
            try {
                // Récupère l'URI de base
                $uri = Route::route($name, $params);
                
                // Construction de l'URL complète si demandé
                if ($absolute) {
                    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                    $scheme = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
                    return $scheme . $host . '/' . ltrim($uri, '/');
                }
                
                return $uri;
                
            } catch (\Exception $e) {
                // Mode développement - affiche les détails
                if (($_ENV['APP_ENV'] ?? 'production') === 'development') {
                    dd([
                        'error' => $e->getMessage(),
                        'route' => $name,
                        'parameters' => $params,
                        'available_routes' => Route::getNamedRoutes()
                    ]);
                }
                
                // Mode production - log et retourne une URL par défaut
                error_log("Route error [{$name}]: " . $e->getMessage());
                return '/';
            }
        }
    }
}

if (!function_exists('asset')) {
    /**
     * Génère une URL pour un fichier statique.
     *
     * @param string $path Chemin du fichier relatif au dossier "public".
     * @return string URL absolue du fichier.
     */
    function asset(string $path): string
    {
        $path = '/' . ltrim($path, '/');
        return '//' . $_SERVER['HTTP_HOST'] . $path; // Utilisation d'un protocole relatif
    }
}

if (!function_exists('url')) {
    /**
     * Génère une URL absolue pour un chemin donné.
     *
     * @param string $path Chemin relatif.
     * @return string URL absolue.
     */
    function url(string $path = ''): string
    {
        $path = '/' . ltrim($path, '/');
        return '//' . $_SERVER['HTTP_HOST'] . $path; // Utilisation d'un protocole relatif
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Génère un champ caché contenant le token CSRF.
     *
     * @return string Champ HTML caché.
     */
    function csrf_field(): string
    {
        return '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Retourne le token CSRF actuel et en génère un nouveau pour la prochaine requête.
     *
     * @return string Token CSRF.
     */
    function csrf_token(): string
    {
        // Si le token CSRF n'existe pas, en générer un nouveau
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Stocker l'ancien token avant de régénérer
        $_SESSION['previous_csrf_token'] = $_SESSION['csrf_token'];

        // Générer un nouveau token CSRF pour la prochaine requête
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Retourner le token actuel (celui qui vient d'être généré)
        return $_SESSION['previous_csrf_token'];
    }
}

if (!function_exists('validate_csrf_token')) {
    /**
     * Valide le token CSRF.
     *
     * @param string $token Token CSRF à valider.
     * @return bool True si le token est valide, sinon false.
     */
    function validate_csrf_token(string $token): bool
    {
        // Vérifier si le token correspond au token actuel ou à l'ancien token
        return $token === ($_SESSION['csrf_token'] ?? '') || $token === ($_SESSION['previous_csrf_token'] ?? '');
    }
}

if (!function_exists('old')) {
    /**
     * Retourne une ancienne valeur de formulaire après une redirection.
     *
     * @param string $key Clé de la valeur.
     * @param mixed $default Valeur par défaut.
     * @return mixed Ancienne valeur ou valeur par défaut.
     */
    function old(string $key, $default = null)
    {
        return $_SESSION['old'][$key] ?? $default;
    }
}

if (!function_exists('session')) {
    /**
     * Récupère ou définit une valeur en session.
     *
     * @param string $key Clé de la session.
     * @param mixed $value Valeur à définir (optionnel).
     * @return mixed Valeur de la session si $value est null, sinon null.
     */
    function session(string $key, $value = null)
    {
        if ($value === null) {
            return $_SESSION[$key] ?? null;
        }
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirige vers une URL.
     *
     * @param string $url URL de redirection.
     * @param int $status Code HTTP (par défaut : 302).
     * @param array $headers En-têtes HTTP supplémentaires.
     * @return Illuminate\Http\RedirectResponse
     */
    function redirect(string $url, int $status = 302, array $headers = []): Illuminate\Http\RedirectResponse
    {
        return new Illuminate\Http\RedirectResponse($url, $status, $headers);
    }
}

if (!function_exists('log')) {
    /**
     * Enregistre un message dans les logs.
     *
     * @param string $message Message à enregistrer.
     * @param array $context Contexte supplémentaire.
     * @return void
     */
    function log(string $message, array $context = []): void
    {
        Illuminate\Support\Facades\Log::info($message, $context);
    }
}

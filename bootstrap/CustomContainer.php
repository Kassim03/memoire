<?php

use Illuminate\Container\Container;

class CustomContainer extends Container
{
    /**
     * Indique si l'application est en mode test.
     *
     * @return bool
     */
    public function runningUnitTests()
    {
        return false; // Retourne false par défaut (pas en mode test)
    }

    /**
     * Retourne le chemin du dossier de stockage.
     *
     * @return string
     */
    public function storagePath()
    {
        return __DIR__ . '/../storage'; // Chemin relatif au dossier de stockage
    }
}
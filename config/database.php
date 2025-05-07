<?php
    // Charger l'autoloader (si ce n'est pas déjà fait dans l'autoloader principal du projet)
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // Charger les variables d'environnement (si nécessaire)
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    
    // Initialiser la connexion à la base de données à partir du package
    use StormBin\Package\Database\Database;
    
    Database::init();  // Cela initialisera la connexion à la base de données

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {
    public function up()
    {
        if (!Capsule::schema()->hasTable('Notifications')) {
            Capsule::schema()->create('Notifications', function (Blueprint $table) {
                $table->id();
                $table->string('message', 1000); // Longueur 1000
                $table->char('statut', 20); // Longueur 20
                $table->timestamps(); // created_at, updated_at

                // Ajoutez ici les autres colonnes nécessaires, par exemple :
                // $table->string('name');
                // $table->integer('age');
            });
            echo "Table 'Notifications' créée avec succès.\n";
        } else {
            echo "La table 'Notifications' existe déjà.\n";
        }
    }

    public function down()
    {
        if (Capsule::schema()->hasTable('Notifications')) {
            Capsule::schema()->dropIfExists('Notifications');
            echo "Table 'Notifications' supprimée.\n";
        } else {
            echo "La table 'Notifications' n'existe pas.\n";
        }
    }
};

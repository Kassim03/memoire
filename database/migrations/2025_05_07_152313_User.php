<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {
    public function up()
    {
        if (!Capsule::schema()->hasTable('Users')) {
            Capsule::schema()->create('Users', function (Blueprint $table) {
                $table->id();
                $table->string('name', 50); // Longueur 100
                $table->string('surname',50);
                $table->integer('telephone');
                $table->string('email', 50); // Longueur 50
                $table->timestamp('email_verified_at')->nullable(); // Longueur 20 (timestamp)
                $table->string('password', 255); // Longueur 255
                $table->timestamps(); // created_at, updated_at
                
                // Ajoutez ici les autres colonnes nécessaires, par exemple :
                // $table->string('name');
                // $table->integer('age');
            });
            echo "Table 'Users' créée avec succès.\n";
        } else {
            echo "La table 'Users' existe déjà.\n";
        }
    }

    public function down()
    {
        if (Capsule::schema()->hasTable('Users')) {
            Capsule::schema()->dropIfExists('Users');
            echo "Table 'Users' supprimée.\n";
        } else {
            echo "La table 'Users' n'existe pas.\n";
        }
    }
};

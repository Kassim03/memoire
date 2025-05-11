<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {
    public function up()
    {
        if (!Capsule::schema()->hasTable('Emplacements')) {
            Capsule::schema()->create('Emplacements', function (Blueprint $table) {
                $table->id();
                $table->char('type_emplacement', 1);
                $table->string('nom', 100);
                $table->string('description', 250);
                $table->decimal('tarif_hr', 10, 2);
                $table->char('statut', 10);
                $table->string('image', 100);
                $table->char('capacites', 20);
                $table->timestamps();

                // Ajoutez ici les autres colonnes nécessaires, par exemple :
                // $table->string('name');
                // $table->integer('age');
            });
            echo "Table 'Emplacements' créée avec succès.\n";
        } else {
            echo "La table 'Emplacements' existe déjà.\n";
        }
    }

    public function down()
    {
        if (Capsule::schema()->hasTable('Emplacements')) {
            Capsule::schema()->dropIfExists('Emplacements');
            echo "Table 'Emplacements' supprimée.\n";
        } else {
            echo "La table 'Emplacements' n'existe pas.\n";
        }
    }
};

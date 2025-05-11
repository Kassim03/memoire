<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {
    public function up()
    {
        if (!Capsule::schema()->hasTable('Paiements')) {
            Capsule::schema()->create('Paiements', function (Blueprint $table) {
                $table->id();
                $table->string('paiement_methode', 50); // Longueur 50
                $table->decimal('montant', 10, 2); // Longueur 10,2 
                $table->date('date_paiement'); // Longueur 10 (type date)
                $table->char('statut', 20); // Longueur 20
                $table->timestamps(); // Longueur 20 (created_at, updated_at)
                
                // Ajoutez ici les autres colonnes nécessaires, par exemple :
                // $table->string('name');
                // $table->integer('age');
            });
            echo "Table 'Paiements' créée avec succès.\n";
        } else {
            echo "La table 'Paiements' existe déjà.\n";
        }
    }

    public function down()
    {
        if (Capsule::schema()->hasTable('Paiements')) {
            Capsule::schema()->dropIfExists('Paiements');
            echo "Table 'Paiements' supprimée.\n";
        } else {
            echo "La table 'Paiements' n'existe pas.\n";
        }
    }
};

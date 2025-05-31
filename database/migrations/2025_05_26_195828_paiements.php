<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('paiement_methode', 50); // Longueur 50
            $table->decimal('montant', 10, 2); // Longueur 10,2 
            $table->date('date_paiement'); // Longueur 10 (type date)
            $table->char('statut', 20); // Longueur 20
            $table->timestamps(); // Longueur 20 (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

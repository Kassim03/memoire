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
        Schema::create("reservations", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emplacement');
            $table->unsignedBigInteger('id_user');
            $table->date('date_reserv');
            $table->datetime('heure_debut');
            $table->datetime('heure_fin');
            $table->enum('statut', ['En cours', 'Terminée', 'Annulée', 'Confirmée']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_emplacement')->references('id')->on('emplacements')->onDelete('cascade');
            $table->timestamps();
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

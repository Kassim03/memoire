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
        Schema::create('emplacements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['salles', 'espace']);
            $table->string('nom', 30);
            $table->string('description', 250);
            $table->decimal('tarif_hr', 10, 2);
            $table->string('image', 100);
            $table->char('capacites', 20);
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

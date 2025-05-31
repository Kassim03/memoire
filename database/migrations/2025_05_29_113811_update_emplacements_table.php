<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('emplacements', function (Blueprint $table) {
            // Supposons que tu ajoutes une colonne
            if (!Schema::hasColumn('emplacements', 'capacites')) {
                $table->integer('capacites')->nullable()->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('emplacements', function (Blueprint $table) {
            $table->dropColumn('capacites');
        });
    }
};

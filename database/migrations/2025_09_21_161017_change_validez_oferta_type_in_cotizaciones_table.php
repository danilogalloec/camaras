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
        Schema::table('cotizaciones', function (Blueprint $table) {
            // cambiar de DATE a INTEGER (días de validez)
            $table->integer('validez_oferta')
                  ->comment('Validez de la oferta en días')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            // volver a DATE si hiciera falta
            $table->date('validez_oferta')->change();
        });
    }
};

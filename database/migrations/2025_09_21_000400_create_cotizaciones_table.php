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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();

            // Datos básicos de la cotización
            $table->string('numero_cotizacion')->unique();
            $table->string('nombre');
            $table->string('cedula');
            $table->string('direccion');
            $table->string('correo');
            $table->string('celular');

            // AHORA guarda días de validez, no una fecha
            $table->integer('validez_oferta')->comment('Validez de la oferta en días');

            // Totales
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('impuesto', 5, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            // Información adicional
            $table->text('notas')->nullable();
            $table->text('condiciones')->nullable();
            $table->enum('estado', ['pendiente', 'aprobada'])->default('pendiente');

            // Relación con cliente una vez aprobado
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};

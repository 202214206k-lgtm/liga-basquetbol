
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('equipo_local_id')
                ->constrained('equipos')
                ->restrictOnDelete();

            $table->foreignId('equipo_visitante_id')
                ->constrained('equipos')
                ->restrictOnDelete();

            $table->dateTime('fecha');
            $table->string('lugar', 150)->nullable();
            $table->unsignedSmallInteger('puntos_local')->default(0);
            $table->unsignedSmallInteger('puntos_visitante')->default(0);
            $table->enum('estado', [
                'programado',
                'en_juego',
                'finalizado',
                'suspendido'
            ])->default('programado');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};

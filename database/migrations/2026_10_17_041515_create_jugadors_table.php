
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->unsignedTinyInteger('dorsal');
            $table->string('posicion', 30)->nullable();
            $table->foreignId('equipo_id')
                ->constrained('equipos')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['equipo_id', 'dorsal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};

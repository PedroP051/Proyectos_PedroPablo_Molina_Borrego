<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('videojuego_genero', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videojuego_id')->constrained()->onDelete('cascade');
            $table->foreignId('genero_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('videojuego_genero');
    }
};

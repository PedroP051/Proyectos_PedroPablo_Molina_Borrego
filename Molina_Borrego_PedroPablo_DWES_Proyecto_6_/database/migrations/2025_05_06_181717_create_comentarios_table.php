<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('comentarios', function (Blueprint $table) {
        $table->id();  
        $table->text('contenido');  
        $table->timestamp('fecha_publicacion');  
        $table->string('autor');  
        $table->foreignId('articulo_id')  
            ->constrained('articulos')  
            ->onDelete('cascade');  
        $table->timestamps();  
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};

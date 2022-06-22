<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colecciones', function (Blueprint $table) {
            $table->id('id_coleccion');
            $table->string('slug_coleccion',100)->unique();
            $table->string('nombre_coleccion',100);
            $table->string('descripcion_coleccion',1000);
            $table->string('titulo_coleccion',100);
            $table->string('subtitulo_coleccion',100);
            $table->boolean('es_principal_coleccion')->default(0);                             
            $table->foreignId('usuario')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colecciones');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetosDigitalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos_digitales', function (Blueprint $table) {
            $table->id('id_objeto_digital');            
            $table->string('slug_objeto_digital',100)->unique();
            $table->string('titulo',100);
            $table->string('resumen',1000)->nullable();
            $table->string('ruta_portada_objeto_digital',1000)->nullable();
            $table->year('año')->nullable();
            $table->date('fecha')->nullable();
            $table->string('licencia_objeto_digital',100)->nullable();
            $table->longText('atributos')->nullable();            
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
        Schema::dropIfExists('objetos_digitales');
    }
}

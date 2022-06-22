<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id('id_archivo');
            $table->string('ruta_archivo',100);
            $table->string('nombre_archivo',100)->nullable();            
            $table->unsignedBigInteger('id_objeto_digital');
            $table->unsignedBigInteger('id_forma');
            $table->unsignedBigInteger('id_formato');
            $table->foreignId('usuario')->constrained('users');
            $table->timestamps();

            $table->foreign('id_objeto_digital')->references('id_objeto_digital')->on('objetos_digitales');
            $table->foreign('id_forma')->references('id_forma')->on('formas');
            $table->foreign('id_formato')->references('id_formato')->on('formatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}

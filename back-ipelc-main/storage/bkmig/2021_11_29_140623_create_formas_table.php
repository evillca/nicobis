<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formas', function (Blueprint $table) {
            $table->id('id_forma');
            $table->string('slug_forma',100)->unique();
            $table->string('nombre_forma',100);
            $table->string('descripcion_forma',100)->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('usuario');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
            $table->foreign('usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicos', function (Blueprint $table) {
            $table->id('id_publico');
            $table->string('slug_publico',100)->unique();
            $table->string('nombre_publico',100);
            $table->string('descripcion_publico',100);            
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
        Schema::dropIfExists('publicos');
    }
}

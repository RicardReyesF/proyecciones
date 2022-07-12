<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->string("carrera");
            $table->string('noControl', 255)->primary();
            $table->string('nombre');
            $table->unsignedInteger('planDeEstudio');
            $table->unsignedSmallInteger('semestre');
            $table->string('estatus');
            $table->string('genero');
            $table->integer('creditosPlan');
            $table->integer('creditosA');
            $table->integer('creditosQueDebeTener');
            $table->float('promedio');
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
        Schema::dropIfExists('alumnos');
    }
};

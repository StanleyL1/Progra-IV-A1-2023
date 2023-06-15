<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSintomasPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sintomas_paciente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->integer('dificultad_respirar')->nullable();
            $table->integer('tos')->nullable();
            $table->integer('nivel_fatiga')->nullable();
            $table->text('actividad_inicio_sintomas')->nullable();
            $table->text('medicina_rescate_usada')->nullable();
            $table->integer('nivel_dolor_cabeza')->nullable();
            $table->integer('temperatura_mas_alta')->nullable();
            $table->text('informacion_adicional')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sintomas_paciente');
    }
}

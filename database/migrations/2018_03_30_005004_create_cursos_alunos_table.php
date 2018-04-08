<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_alunos', function (Blueprint $table) {
            $table->integer('aluno_id')->unsigned();
            $table->integer('curso_id')->unsigned();

            $table->foreign('aluno_id')->references('id')->on('alunos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cursos_alunos');
    }
}

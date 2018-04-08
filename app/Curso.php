<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function alunos(){
        return $this->belongsToMany(Aluno::class,'cursos_alunos');
    }

    public function professor(){
        return $this->belongsTo(Professor::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep'
    ];

    public function cursos(){
        return $this->belongsToMany(Curso::class,'cursos_alunos');
    }
}

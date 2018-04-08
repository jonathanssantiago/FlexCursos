<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
        'nome',
        'data_nascimento'
    ];

    public function cursos(){
        return $this->hasMany(Curso::class);
    }

}
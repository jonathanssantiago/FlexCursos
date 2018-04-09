<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => '/'], function (){
    Route::get('/', ['as' => 'inicio', 'uses' => 'CursoController@inicio']);

    Route::get('curso/show/{id}', ['as' => 'curso.show', 'uses' => 'CursoController@show']);
    Route::get('aluno/cadastro', ['as' => 'aluno.create', 'uses' => 'AlunoController@create']);
});

Route::group(['prefix' => 'dashboard'], function (){
    Route::get('/', ['as' => 'dashboard.index', function(){ return view('dashboard.index'); }]);

    Route::get('aluno/index', ['as' => 'aluno.index', 'uses' => 'AlunoController@index']);
    Route::get('aluno/show/{id}', ['as' => 'aluno.show', 'uses' => 'AlunoController@show']);

    Route::get('curso/index', ['as' => 'curso.index', 'uses' => 'CursoController@index']);

    Route::get('professor/index', ['as' => 'professor.index', 'uses' => 'ProfessorController@index']);
});

Route::group(['prefix' => 'api'], function () {

    Route::group(['prefix' => 'aluno'], function (){
        Route::post('cpf', ['as' => 'aluno.cpf', 'uses' => 'AlunoController@getCPF']);
        Route::get('list', ['as' => 'aluno.list', 'uses' => 'AlunoController@list']);
        Route::post('store', ['as' => 'aluno.store', 'uses' => 'AlunoController@store']);
        Route::put('curso', ['as' => 'aluno.curso.update', 'uses' => 'AlunoController@updateCurso']);
        Route::put('update/{id}', ['as' => 'aluno.update', 'uses' => 'AlunoController@update']);
        Route::delete('delete/{id}', ['as' => 'aluno.delete', 'uses' => 'AlunoController@delete']);
    });

    Route::group(['prefix' => 'curso'], function (){
        Route::get('id/{id}', ['as' => 'curso.get', 'uses' => 'CursoController@get']);
        Route::get('list', ['as' => 'curso.list', 'uses' => 'CursoController@getAll']);
        Route::post('store', ['as' => 'curso.store', 'uses' => 'CursoController@store']);
        Route::post('search', ['as' => 'curso.search', 'uses' => 'CursoController@search']);
        Route::put('update', ['as' => 'curso.update', 'uses' => 'CursoController@update']);
        Route::delete('delete/{id}', ['as' => 'curso.delete', 'uses' => 'CursoController@destroy']);
    });

    Route::group(['prefix' => 'professor'], function (){
        Route::get('id/{id}', ['as' => 'professor.get', 'uses' => 'ProfessorController@get']);
        Route::get('list', ['as' => 'professor.list', 'uses' => 'ProfessorController@getAll']);
        Route::post('store', ['as' => 'professor.store', 'uses' => 'ProfessorController@store']);
        Route::put('update', ['as' => 'professor.update', 'uses' => 'ProfessorController@update']);
        Route::delete('delete/{id}', ['as' => 'professor.delete', 'uses' => 'ProfessorController@destroy']);
    });
});
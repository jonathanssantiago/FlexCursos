<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Http\Requests\ProfessorRequest;
use App\Professor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProfessorController extends Controller
{
    /**
     * @var Professor
     */
    private $professor;

    /**
     * ProfessorController constructor.
     */
    public function __construct(Professor $professor)
    {
        $this->professor = $professor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = $this->professor->orderBy('id','desc')->paginate(10);

        return view('dashboard.professor.index', compact('data'));
    }

    public function get($id){
        $data = $this->professor->find($id);
        if(!$data){
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possivel encontrar o registro!',
                'data' => null
            ],404);
        }
        return Response()->json([
            'status' => true,
            'msg' => ' Registros encontrado!',
            'data' => $data
        ], 200);
    }


    public function getAll()
    {
        $data = $this->professor->orderBy('id','desc')->get();
        if(!$data){
            return Response()->json([
                'status' => false,
                'msg' => 'Não existem registros cadastrados!',
                'data' => null
            ], 404);
        }
        return Response()->json([
            'status' => true,
            'msg' => $data->count().' Registros encontrados!',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessorRequest $request)
    {
        $form = $request->all();
        $form['data_nascimento'] = date('Y-d-m', strtotime(trim(strip_tags($request->input('data_nascimento')))));

        $data = $this->professor->create($form);

        $cursos = explode(',', $request->input('curso_id'));

        if($cursos[0] != 'null'){
            $selected = [];

            foreach ($cursos as $curso_id) {
                $selected[] = Curso::find($curso_id);
            }
            $data->cursos()->saveMany($selected);
        }

        if($data->count() == 0){
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possível concluir seu cadastro!',
                'data' => null
            ], 404);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Cadastrado com Sucesso!',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessorRequest $request)
    {
        $professor = $this->professor->find( $request->input('id'));

        $form = $request->all();
        $form['data_nascimento'] = date('Y-d-m', strtotime(trim(strip_tags($request->input('data_nascimento')))));

        $data = $professor->update($form);

        $cursos = explode(',', $request->input('curso_id'));

        if($cursos[0] != 'null'){
            $selected = [];

            foreach($professor->cursos()->get() as $curso){
                $curso->professor()->dissociate($professor->id)->save();
            }

            foreach ($cursos as $curso_id) {
                $selected[] = Curso::find($curso_id);
            }

            $professor->cursos()->saveMany($selected);
        }

        if(!$data){
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possível atualizar o cadastro!',
                'data' => null
            ], 404);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Cadastrado com Sucesso!',
            'data' => $professor
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->professor->find($id);

        if ($data->count() == 0){
            return Response()->json([
                'status' => false,
                'msg' => 'O Registro não foi Encontrado!'
            ], 404);
        }else{
            $data->delete();
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Apagado com Sucesso!'
        ], 200);
    }
}

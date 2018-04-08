<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Http\Requests\CursoRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CursoController extends Controller
{
    /**
     * @var Curso
     */
    private $curso;

    /**
     * CursoController constructor.
     */
    public function __construct(Curso $curso)
    {
        $this->curso = $curso;
    }


    public function inicio(){
        $data = $this->curso->orderBy('id','desc')->paginate(10);

        return view('inicio', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = $this->curso->orderBy('id','desc')->paginate(10);

        return view('dashboard.curso.index', compact('data'));
    }


    public function get($id){
        $data = $this->curso->find($id);
        if($data->count() == 0){
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possivel encontrar o registro!',
                'data' => null
            ],404);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro encontrado!',
            'data' => $data
        ],200);
    }

    public function getAll()
    {
        $data = $this->curso->orderBy('id','desc')->get();
        if($data->count() == 0){
            return Response()->json([
                'status' => false,
                'msg' => '<h3 style="font-family: SansSerif; color: darkred;">Nenhum Curso foi Cadastrado.</h3>',
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
    public function store(CursoRequest $request)
    {
        $data = $this->curso->create($request->all());
        if($request['professor_id'] != 'null'){
            $data->professor()->associate($request['professor_id'])->save();
        }
        if($data->count() == 0){
            return response()->json([
                'status' => false,
                'msg' => 'Não foi possível cadastrar o curso!',
                'data' => null
            ], 500);
        }
        return response()->json([
            'status' => true,
            'msg' => 'Registro Cadastrado com Sucesso!',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = $this->curso->find($id);
        return view('visualizar', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CursoRequest $request)
    {
        $curso = $this->curso->find($request->input('id'));
        $data = $curso->update($request->all());

        if($request['professor_id'] != 'null'){
            $curso->professor()->associate($request['professor_id'])->save();
        }
        if(!$data){
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi Possível Editar esse Registro!',
                'data' => null
            ],500);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Atualizado com Sucesso!',
            'data' => $curso
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
        $data = $this->curso->find($id);

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

    public function search(Request $request){
        $value = $request->input('search');
        $data = $this->curso->orderBy('id','desc')->where('nome','like',"%$value%")
            ->orWhere('descricao','like',"%$value%")->get();

        if($data->count() == 0){
            return Response()->json([
                'status' => false,
                'msg' => '<h5 style="font-family: \'Arial Unicode MS\'; color: #9d9d9d;">Nenhum Registro foi encontrado para a pesquisa: <b>' .$value. '</b></h5>',
                'data' => null
            ],404);
        }
        return Response()->json([
            'status' => true,
            'msg' => '<h5 style="color: #9d9d9d;font-family: \'Arial Unicode MS\'">Os Resultados encontrados para a pesquisa: <b>'. $value. '</b> foram '.$data->count().'.</h5>',
            'data' => $data
        ], 200);

    }
}

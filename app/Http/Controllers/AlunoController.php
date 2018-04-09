<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use App\Http\Requests\AlunoRequest;
use Dompdf\Dompdf;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AlunoController extends Controller
{
    /**
     * @var Aluno
     */
    private $aluno;

    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = $this->aluno->orderBy('id','desc')->paginate(10);

        return view('dashboard.aluno.index', compact('data'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $data = $this->aluno->orderBy('id', 'desc')->get();
        if ($data->count() == 0) {
            return Response()->json([
                'status' => false,
                'msg' => 'Não foram encontrado registros!',
                'data' => null
            ], 404);
        }
        return Response()->json([
            'status' => true,
            'msg' => $data->count() . ' Registros encontrados!',
            'data' => $data
        ], 200);
    }

    public function getCPF(Request $request)
    {
        $data = $this->aluno->where('cpf', $request->input('cpf'))->with('cursos')->first();

        if (!$data) {
            return Response()->json([
                'status' => false,
                'msg' => 'Não foram encontrado registros!',
                'data' => null
            ], 404);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro encontrado!',
            'data' => $data
        ], 200);
    }

    /**
     * Shows the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aluno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoRequest $request)
    {
        $form = $request->all();
        $form['data_nascimento'] = date('Y-d-m', strtotime(trim(strip_tags($form['data_nascimento']))));

        $data = $this->aluno->create($form);

        if($request->input('curso_id')){
            $data->cursos()->attach($request->input('curso_id'));
        }

        if ($data->count() == 0) {
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possível concluir seu cadastro!',
                'data' => null
            ], 500);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Cadastrado com Sucesso!',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->aluno->find($id);

        $pdf = \PDF::loadView('dashboard.aluno.show',compact('data'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = $this->aluno->find($id);
        return view('aluno.edit', compact($aluno));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlunoRequest $request)
    {
        $aluno = $this->aluno->find($request->input('id'));

        $form = $request->all();
        $form['data_nascimento'] = date('Y-d-m', strtotime(trim(strip_tags($request->input('data_nascimento')))));

        $data = $aluno->update($request->all());

        $cursos = explode(',', $request->input('curso_id'));

        if($cursos[0]){
            $selected = [];
            foreach ($cursos as $curso_id) {
                $selected[] = Curso::find($curso_id);
            }
            $aluno->cursos()->sync($selected);
        }

        if (!$data) {
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possível atualizar seu cadastro!',
                'data' => null
            ]);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Cadastrado com Sucesso!',
            'data' => $aluno
        ]);
    }

    public function updateCurso(Request $request)
    {
        $aluno = $this->aluno->find($request->input('id'));

        $cursos = explode(',', $request->input('curso_id'));

        if($cursos[0]){
            $selected = [];
            foreach ($cursos as $curso_id) {
                $selected[] = $curso_id;
            }
            $aluno->cursos()->attach($selected);
        }

        if (!$cursos[0]) {
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possível atualizar seu cadastro!',
                'data' => null
            ]);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Cadastrado com Sucesso!',
            'data' => $aluno
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->aluno->find($id);
        $data->delete();

        if (!$data) {
            return Response()->json([
                'status' => false,
                'msg' => 'Não foi possível apagar o registro!',
                'data' => null
            ], 500);
        }
        return Response()->json([
            'status' => true,
            'msg' => 'Registro Apagado com Sucesso!'
        ],200);

    }
}

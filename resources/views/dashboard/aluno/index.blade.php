@extends('content')
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header text-center">
                    <i class="icon-big icon-primary fas fa-tachometer-alt"></i>
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="{{url('/dashboard')}}" style="color:black">Dashboard</a></li>
                    <li role="presentation"><a href="{{route('curso.index')}}" style="color:black">Cursos</a></li>
                    <li role="presentation"  class="active"><a href="{{route('aluno.index')}}">Alunos</a></li>
                    <li role="presentation"><a href="{{route('professor.index')}}"style="color:black">Professores</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <br>
        <div class="col-md-3 col-md-offset-2">
            <br><br>
        </div>

        <br>
        <div id="status" role="alert"></div>

        <section class="contentDashboard">
            <div class="row">
                @if(count($data) == 0)
                    <h2>Nenhum Aluno Cadastrado!.</h2>
                @else
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Nome</th>
                                <th>Data de Nascimento</th>
                                <th>Cursos Cadastrados</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            @foreach($data as $reg)
                                <tbody>
                                <td>{{$reg->id}}</td>
                                <td>{{$reg->nome}}</td>
                                <td>{{date('d/m/Y', strtotime($reg->data_nascimento))}}</td>
                                <td>
                                    @if(count($reg->cursos) > 0)
                                        @foreach($reg->cursos as $curso)
                                            {{$curso->nome}};
                                        @endforeach
                                    @else
                                        Não Possui
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('aluno.show',$reg->id)}}" target="_blank" title="Editar">
                                        <i class="icon-primary icon-big fa fa-eye"></i></a>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="row">{!! $data->render() !!}</div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('modal-section')
    @include('dashboard.professor.modal')
@endsection

@section('post-script')
    <script src="{{url('app/professor.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.mask.js')}}"></script>
    <script>$('#data_nascimento').mask('00/00/0000', {reverse: true});</script>
    <script>$('#inputDataEdit').mask('00/00/0000', {reverse: true});</script>
@endsection
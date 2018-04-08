@extends('content')
@section('body')
    <section id="headerNoticia">
        <div class="container">
            <div class="page-header text-center">
                <h1>{{$curso->nome}}</h1>
            </div>

            <div class="text-center">
                @if(count($curso->professor) > 0)
                    <h5>
                        <i class="glyphicon glyphicon-user"></i> Professor: <b>{{$curso->professor->nome}}</b>
                    </h5>
                @endif
                <small>{{$curso->created_at->format('d/m/Y H:i')}}</small>
            </div>
        </div>
    </section>
    <section id="imagemNoticia">
        <div class="container-fluid">
            <div class="text-center">
                <img src="{{url('image/cursos.png')}}" alt="Cursos">
            </div>
        </div>
    </section>

    <section id="contentNoticia">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <p>
                    {{$curso->descricao}}
                </p>
            </div>
        </div>
    </section>
    <br>
    <section>
        <div class="col-lg-12 text-center">
            <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalInscAluno">Inscreva-se</button>
        </div>
        <br><br>
    </section>
@endsection
@section('modal-section')
    @include('aluno.modal')
@endsection
@section('post-script')
    <script src="{{url('app/aluno.js')}}" type="text/javascript"></script>
    <script src="{{url('js/cep.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.mask.js')}}"></script>
    <script>$('#cpf').mask('000.000.000-00', {reverse: true});</script>
    <script>$('#data_nascimento').mask('00/00/0000', {reverse: true});</script>
    <script>$('#cep').mask('00000-000', {reverse: true});</script>
    <script src="{{url('app/alunoForm.js')}}"></script>
@endsection
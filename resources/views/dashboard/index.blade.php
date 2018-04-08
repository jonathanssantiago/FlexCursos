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
                    <li role="presentation" class="active"><a href="#">Dashboard</a></li>
                    <li role="presentation"><a href="{{route('curso.index')}}" style="color:black">Cursos</a></li>
                    <li role="presentation"><a href="{{route('aluno.index')}}" style="color:black">Alunos</a></li>
                    <li role="presentation"><a href="{{route('professor.index')}}" style="color:black">Professores</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <br>
    <div class="content">
        <div class="title">
            <h2 class="text-center primary">Bem-Vindo ao Painel de Controle!</h2>
        </div>
    </div>
@endsection
@section('post-script')

@endsection
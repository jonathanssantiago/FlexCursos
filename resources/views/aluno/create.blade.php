@extends('home')

@section('content')

    <div class="container">
        <div class="page-header">
            <h2>Cadastrar
                <small> Notícia</small>
            </h2>
        </div>
        @if(count($errors))
            <br>
            <div class="alert alert-danger" data-dismiss="alert" aria-label="Close">
                <strong>Whoops!</strong> <span class="pull-right"
                                               aria-hidden="true">&times;</span>
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: #fff">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <br>
            <div class="alert alert-success" data-dismiss="alert" aria-label="Close">
                <span class="pull-right"
                      aria-hidden="true">&times;</span>
                {{ session('status') }}
            </div>
        @endif

        <div class="col-md-8 col-md-offset-2">
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control" name="author" minlength="3" placeholder="Autor" value="{{old('author')}}"
                           data-error="Preencha um nome válido!." required>
                    <span class="glyphicon form-control-feedback"></span>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" name="title" minlength="3" placeholder="Título" value="{{old('title')}}"
                           data-error="Preencha um título válido!." required>
                    <span class="glyphicon form-control-feedback"></span>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label for="descripition">Descrição</label>
                    <textarea class="form-control" name="content" cols="30" rows="5" required>
                        {{old('content')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="file">Imagem</label>
                    <input type="file" name="image">
                </div>
                <button type="reset" class="btn btn-danger">Limpar</button>
                <button type="submit" class="btn btn-success">Postar</button>
            </form>
        </div>
    </div>

@endsection
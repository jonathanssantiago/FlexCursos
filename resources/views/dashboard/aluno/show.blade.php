<!doctype html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="author" content="Jonathan Santiago">
    <title>FlexPeak</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
          integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h4 class="title"><strong>INFORMAÇÕES PESSOAIS</strong></h4>
    <hr>
    <div class="row">
        <div class="col-xs-4">
            <label for="nome">Nome</label>
            <h4>{{$data->nome}}</h4>
        </div>
        <div class="col-xs-4">
            <label for="nome">Data de Nascimento</label>
            <h4>{{date('d/m/Y', strtotime($data->data_nascimento))}}</h4>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <label for="nome">CPF</label>
                <h4>{{$data->cpf}}</h4>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-4">
            <label for="nome">Logradouro, Número</label>
            <h4>{{$data->logradouro}}, {{$data->numero}}</h4>
        </div>
        <div class="col-xs-2">
            <label for="nome">Bairro</label>
            <h4>{{$data->bairro}}</h4>
        </div>
        <div class="col-xs-3">
            <label for="nome">Cidade/UF</label>
            <h4>{{$data->cidade}}/{{$data->estado}}</h4>
        </div>
        <div class="col-xs-3">
            <label for="nome">CEP</label>
            <h4>{{$data->cep}}</h4>
        </div>
    </div>
    <hr>
    <h4 class="title"><strong>CURSOS MATRICULADOS</strong></h4>
    <hr>
    @if(count($data->cursos) > 0)
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Curso</th>
                        <th class="text-center">Professor</th>
                    </tr>
                </thead>
                @foreach($data->cursos as $curso)
                    <tbody>
                        <tr>
                            <td class="text-center">{{$curso->nome}}</td>
                            <td class="text-center">
                                @if($curso->professor)
                                    {{$curso->professor->nome}}
                                    @else
                                    Sem Professor
                                @endif

                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        @else
            O Aluno ainda não se cadastrou em nenhum Curso!
    @endif
</div>
</body>
</html>
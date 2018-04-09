@extends('content')
@section('body')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>CURSOS
                    <small>Disponíveis</small>
                </h1>
            </div>

            <div class="col-md-3 pull-right">
                <form id="formSearch" method="post">
                    <div class="input-group">
                        <input type="text" id="search" class="form-control"
                               placeholder="Pesquisar Cursos">
                        <span class="input-group-btn">
                            <button class="btn btn-info glyphicon glyphicon-search" type="submit"></button>
                        </span>
                    </div><!-- /input-group -->
                </form>
            </div>
            <br>
            <br>
            <div id="listCurso"></div>
        </div>
        {!! $data->render() !!}
    </div>
@endsection
@section('post-script')
    <script type="text/javascript">
        $(document).ready(function () {
            var url = '../../api/curso/list';
            var response = $.get(url);
            var listCurso = $('#listCurso').empty();

            response.success(function (resposta) {
                cursos = resposta.data;
                $.each(cursos, function (key, value) {
                    listCurso.append('<div class="col-sm-6 col-md-3"><div class="thumbnail"><img src="{{url('image/cursos.png')}}" alt="Cursos"><div class="caption"><h3>'+ value.nome +'</h3><h5></h5><p id="textDescricao'+ value.id +'">' + value.descricao + '</p><p class="text-center"><a href=../../curso/show/'+value.id +' class="btn btn-success" role="button">Ver Mais</a></p></div></div></div>');
                    $('#textDescricao'+ value.id).text($('#textDescricao'+ value.id).text().substring(0,100)).append('...');
                });
            });

            response.error(function (r) {
                listCurso.append('<h4>'+ r.responseJSON.msg +'</h4>');
            });
        });
    </script>
    <script type="text/javascript">

        $('#formSearch').on('submit', function (e) {
            e.preventDefault();
            search();
        });

        function search() {
            var url = '../../api/curso/search';
            var vData = new FormData();
            vData.append('search', $('#search').val());
            var listCurso = $('#listCurso').empty();

            var resposta = $.ajax({
                type: 'POST',
                url: url,
                data: vData,
                processData: false,
                contentType: false
            });

            resposta.success(function (response) {
                cursos = response.data;
                listCurso.append('<h4>'+ response.msg +'</h4>');

                $.each(cursos, function (key, value) {
                    listCurso.append('<div class="col-sm-6 col-md-3"><div class="thumbnail"><img src="{{url('image/cursos.png')}}" alt="Cursos"><div class="caption"><h3>'+ value.nome +'</h3><h5></h5><p id="textDescricao'+ value.id +'">' + value.descricao + '</p><p class="text-center"><a href=../../curso/show/'+value.id +' class="btn btn-success" role="button">Ver Mais</a></p></div></div></div>');
                    $('#textDescricao'+value.id).text($('#textDescricao'+value.id).text().substring(0,100)).append('...');
                });
            });
            resposta.error(function (response) {
                listCurso.append('<h4>'+ response.responseJSON.msg +'</h4>');
            });
        }
    </script>
@endsection
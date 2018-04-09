$(document).ready(function (e) {
    $('#cpf').blur(function () {
        var cpf = $('#cpf').val();
        var curso_id = $('#curso_id').val();
        var url = '../../api/aluno/cpf';
        var response = $.post(url,{cpf: cpf});
        var cursoMat = false;
        response.success(function (r) {
            $('#groupCPF').html('');
            $.each(r.data.cursos, function (key, value) {
                if (value.id === parseInt(curso_id)) {
                    cursoMat = true;
                }
            });


            var area = $('#area');
            area.html('');
            if (cursoMat === true) {
                area.append("<h4 style='color:#9d9d9d;text-align: center'>Olá " + r.data.nome + " você já está inscrito neste Curso!</h4>");
            } else {
                area.append("<h4 style='color:#9d9d9d;text-align: center'>Olá " + r.data.nome + " você deseja inscrever-se nesse curso?</h4>");
                area.append('<div class="col-sm-4 col-sm-offset-4"><a class="btn btn-success btn-lg" onClick="attCurso(' + r.data.id + ',' + curso_id + ')"><i class="fa fa-sign-in"></i>Quero Me Inscrever!</a></div>');
            }
        });
        response.error(function (r) {
            var form = $('#inscForm');
            console.log(r);
            form.html('');
            $('#groupCPF').html('');

            form.append("<h4 style='color:#9d9d9d;text-align: center'>Informe seus Dados Pessoais!</h4>");
            form.append("<input type='hidden' id='cpf' name='cpf' value=" + cpf + "> </input>");
            form.append("<input type='hidden' id='curso_id' name='curso_id' value=" + curso_id + "> </input>");
            form.append("<div class='col-md-8'><div class='form-group'><label>Nome:</label><input type='text' class='form-control' id='nome' placeholder='Informe o seu nome' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>Data de Nascimento:</label><input type='text' class='form-control' id='data_nascimento' placeholder='Informe sua Data de Nascimento' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>Cep:</label><input type='text' class='form-control' id='cep' placeholder='Informe seu CEP' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>Logradouro:</label><input type='text' class='form-control' id='logradouro' placeholder='Informe sua Rua' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>Número:</label><input type='text' class='form-control' id='numero' placeholder='Informe o número de sua Residência' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>Bairro:</label><input type='text' class='form-control' id='bairro' placeholder='Informe o bairro de sua Residência' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>Cidade:</label><input type='text' class='form-control' id='cidade' placeholder='Informe a cidade de sua Residência' required></div></div>");
            form.append("<div class='col-md-4'><div class='form-group'><label>UF:</label><input type='text' class='form-control' id='uf' placeholder='Informe o Estado de sua Residência' required></div>");
            form.append("<div class='col-sm-12'><button type='submit' class='btn btn-success pull-right'><i class='fa fa-sign-in'></i>Salvar</button></div>");
            cepWS();
        });
    })
});
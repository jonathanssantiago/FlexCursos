$('#inscForm').on('submit', function (e) {
    e.preventDefault();
    storeInsc();
});

function storeInsc() {
    var url = '../../api/aluno/store';
    var data = formStore();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (value) {
            $('#status').addClass('alert alert-success').append("<span>Inscrição Realizada com Sucesso!</span>");
            setTimeout(function () {
                $('#status').removeClass('alert').html('');
                history.go(0);
            }, 2000);
        },
        error: function (result) {
            $('#status').addClass('alert alert-danger').append("<span>Não Foi Possivel concluir seu cadastro!</span>");
            setTimeout(function () {
                $('#status').removeClass('alert').html('');
            }, 3000);
        }
    });
}

function attCurso(id, curso) {
    var url = '../../api/aluno/curso';
    var data = new FormData();
    data.append('id', id);
    data.append('curso_id',curso);
    data.append('_method','put');
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (value) {
            $('#area').html('');
            $('#status').addClass('alert alert-success').append("<span>Olá " + value.data.nome + " sua Inscrição foi Realizada com Sucesso!</span>");
            setTimeout(function () {
                $('#status').removeClass('alert alert-success').html('');
                history.go(0);
            }, 4000);
        },
        error: function (result) {
            $('#status').addClass('alert alert-danger').append("<span>Não Foi Possivel concluir seu cadastro!</span>");
            setTimeout(function () {
                $('#status').removeClass('alert alert-danger').html('');
            }, 3000);
        }
    });
}

function formStore() {
    var vData = new FormData();

    vData.append('nome', $('#nome').val());
    vData.append('data_nascimento', $('#data_nascimento').val());
    vData.append('cpf', $('#cpf').val());
    vData.append('cep', $('#cep').val());
    vData.append('logradouro', $('#logradouro').val());
    vData.append('numero', $('#numero').val());
    vData.append('bairro', $('#bairro').val());
    vData.append('cidade', $('#cidade').val());
    vData.append('estado', $('#uf').val());
    vData.append('curso_id', $('#curso_id').val());

    return vData;
}

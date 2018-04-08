$('#formStoreProf').on('submit', function (e) {
    e.preventDefault();
    storeProf();
});

$('#formEditProf').on('submit', function (e) {
    e.preventDefault();
    EditProf();
});

function storeProf() {
    var url = '../../api/professor/store';
    var data = formStore();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (value) {
            if (value.status === true) {
                $('#statusCadProf').addClass('alert alert-success').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusCadProf').removeClass('alert').html('');
                    history.go(0);
                }, 2000);
            } else if (value.status === false) {
                $('#statusCadProf').addClass('alert alert-danger').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusCadProf').removeClass('alert').html('');
                }, 2000);
            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function EditProf() {
    var url = '../../api/professor/update';
    var data = formUpdate();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (value) {
            if (value.status === true) {
                $('#statusEditProf').addClass('alert alert-success').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusEditProf').removeClass('alert').html('');
                    history.go(0);
                }, 2000);
            } else if (value.status === false) {
                $('#statusEditProf').addClass('alert alert-danger').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusEditProf').removeClass('alert').html('');
                }, 2000);
            }
        },
        error: function (result) {
            if(result.status === 422){
                $('#statusEditProf').addClass('alert alert-danger').append('<p> Ops!, Você esqueceu de Preencher Algum Campo. </p>');
                setTimeout(function () {
                    $('#statusEditProf').removeClass('alert').html('');
                }, 3000);
            }
        }
    });
}

function modalProfEdit(id) {
    var area = $('#areaEdit');
    area.html('');
    var url = '../../api/professor/id/' + id;
    $.ajax({
        type: 'GET',
        url: url,
        success: function (result) {
            $('#modalEditProf').modal('show');
            area.append("<input type='hidden' id='id' name='id' value="+ result.data.id +"> </input>");
            area.append("<div class='form-group'><label for='' class='col-sm-2 control-label'>Nome do Professor:</label><div class='col-sm-8'><input type='text' class='form-control' id='inputNomeEdit' placeholder='Informe o nome do Professor' required value="+result.data.nome+"></div></div>");
            area.append("<div class='form-group'><label class='col-sm-2 control-label'>Data de Nascimento:</label><div class='col-sm-5'><input type='text' class='form-control' id='inputDataEdit' placeholder='Informe a Data de Nascimento' required value="+result.data.data_nascimento+"></div></div>");
            area.append("<div class='form-group'><label class='col-sm-2 control-label'>Cursos Ministrados:</label><div class='col-sm-5'><select name='curso_id' class='selectpicker' id='inputCursosEdit' multiple></select></div></div>");
            getAllCursos();
        },
        error: function (result) {
            console.log(result);
        }
    });
}
function formStore() {
    var vData = new FormData();

    vData.append('nome', $('#inputProf').val());
    vData.append('data_nascimento', $('#data_nascimento').val());
    vData.append('curso_id', $('#inputCursos').val());

    return vData;
}

function formUpdate() {
    var vData = new FormData();
    vData.append('id', $('#id').val());
    vData.append('nome', $('#inputNomeEdit').val());
    vData.append('data_nascimento', $('#inputDataEdit').val());
    vData.append('curso_id', $('#inputCursosEdit').val());
    vData.append('_method', 'put');

    return vData;
}

function removeProf(id) {
    var resposta = confirm('Deseja Realmente Deletar o Registro ?');
    if(resposta === true){
        var url = '../../api/professor/delete/' + id;
        $.ajax({
            type: 'delete',
            url: url,
            data: {id: id},
            datatype: 'json',
            success: function (value) {
                if (value.status === true) {
                    $('#status').addClass('alert alert-success').append('<p>' + value.msg + ' </p>');
                    setTimeout(function () {
                        $('#status').removeClass('alert').html('');
                        history.go(0);
                    }, 2000);
                } else if (value.status === false) {
                    $('#status').addClass('alert alert-danger').append('<p>' + value.msg + ' </p>');
                    setTimeout(function () {
                        $('#status').removeClass('alert').html('');
                    }, 2000);
                }
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
}

function getAllCursos() {
    var url = '../../api/curso/list';
    $('#inputCursosEdit').empty();

    var resposta = $.get(url);

    resposta.success(function (response) {
        var cursos = response.data;
        $.each(cursos, function (key, value) {
            $('#inputCursosEdit').append('<option value=' + value.id + '>' + value.nome  + '</option>');
            $('.selectpicker').selectpicker("refresh");
        })
    });
    resposta.error(function (response) {
        $('.selectpicker').selectpicker("refresh");
    });

}

$('#formStoreCurso').on('submit', function (e) {
    e.preventDefault();
    storeCurso();
});

$('#formEditCurso').on('submit', function (e) {
    e.preventDefault();
    EditCurso();
});

function storeCurso() {
    var url = '../../api/curso/store';
    var data = form();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (value) {
            if (value.status === true) {
                $('#statusCadCurso').addClass('alert alert-success').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusCadCurso').removeClass('alert').html('');
                    history.go(0);
                }, 2000);
            } else if (value.status === false) {
                $('#statusCadCurso').addClass('alert alert-danger').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusCadCurso').removeClass('alert').html('');
                }, 2000);
            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function EditCurso() {
    var url = '../../api/curso/update';
    var data = formUpdate();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (value) {
            if (value.status === true) {
                $('#statusEditCurso').addClass('alert alert-success').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusEditCurso').removeClass('alert').html('');
                    history.go(0);
                }, 2000);
            } else if (value.status === false) {
                $('#statusEditCurso').addClass('alert alert-danger').append('<p>' + value.msg + ' </p>');
                setTimeout(function () {
                    $('#statusEditCurso').removeClass('alert').html('');
                }, 2000);
            }
        },
        error: function (result) {
            if(result.status === 422){
                $('#statusEditCurso').addClass('alert alert-danger').append('<p> Ops!, Você esqueceu de Preencher Algum Campo. </p>');
                setTimeout(function () {
                    $('#statusEditCurso').removeClass('alert').html('');
                }, 3000);
            }
        }
    });
}

function modalCursoEdit(id) {
    var area = $('#areaEdit');
    area.html('');
    var url = '../../api/curso/id/' + id;
    $.ajax({
        type: 'GET',
        url: url,
        success: function (result) {
            $('#modalEditCurso').modal('show');
            area.append("<input type='hidden' id='id' name='id' value="+ result.data.id +"> </input>");
            area.append("<div class='form-group'><label for='' class='col-sm-2 control-label'>Nome do Curso:</label><div class='col-sm-10'><input type='text' class='form-control' id='inputCursoEdit' placeholder='Informe o nome do Curso' required value="+result.data.nome+"></div></div>");
            area.append("<div class='form-group'><label class='col-sm-2 control-label'>Professor do Curso:</label><div class='col-sm-5'><select name='professor_id' class='selectpicker' id='inputProfEdit'></select></div></div>");
            area.append("<div class='form-group'><label class='col-sm-2 control-label'>Descrição:</label><div class='col-sm-10' id='areaDesc'><textarea name='descricao' class='form-control' id='inputDescEdit' cols='30' rows='10' placeholder='Insira informações sobre o Curso' required>" + result.data.descricao + "</textarea></div></div>");
            getAllProf();
        },
        error: function (result) {
            console.log(result);
        }
    });
}
function form() {
    var vData = new FormData();
    vData.append('id', $('#id').val());
    vData.append('nome', $('#inputCurso').val());
    vData.append('descricao', $('#inputDesc').val());
    vData.append('professor_id', $('#inputProf').val());

    return vData;
}

function formUpdate() {
    var vData = new FormData();
    vData.append('id', $('#id').val());
    vData.append('nome', $('#inputCursoEdit').val());
    vData.append('descricao', $('#inputDescEdit').val());
    vData.append('professor_id', $('#inputProfEdit').val());
    vData.append('_method', 'put');

    return vData;
}

function removeCurso(id) {
    var resposta = confirm('Deseja Realmente Deletar o Registro ?');
    if(resposta === true){
        var url = '../../api/curso/delete/' + id;
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

function getAllProf() {
    var url = '../../api/professor/list';

    $.get(url, function (response) {
        $('#inputProfEdit').empty();
        var professores = response.data;
        $.each(professores, function (key, value) {
            $('#inputProfEdit').append('<option value=' + value.id + '>' + value.nome  + '</option>');
        });
        $('.selectpicker').selectpicker("refresh");
    });
}

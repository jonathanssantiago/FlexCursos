<div class="modal fade bs-example-modal-lg" id="modalCadProf" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h4 class="modal-title"><i class="fa fa-user"></i> Cadastre Um Novo Professor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="statusCadProf" role="alert"></div>
                <form id="formStoreProf" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Nome do Professor:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputProf"
                                   placeholder="Informe o nome do Professor" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Data de Nascimento:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="data_nascimento" placeholder="Informe a Data de Nascimento" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Cursos Ministrados:</label>
                        <div class="col-sm-8">
                            <select name="cursos_id[]" class="selectpicker" id="inputCursos" multiple title="Cursos">
                                @if(count(\App\Curso::all()) > 0)
                                    @foreach(\App\Curso::all() as $curso)
                                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-sign-in"></i>
                                Entrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalEditProf" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h4 class="modal-title"><i class="fa fa-user"></i> Editar Professor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="statusEditProf" role="alert"></div>
                <form id="formEditProf" class="form-horizontal">
                    <div id="areaEdit"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-sign-in"></i>
                                Entrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
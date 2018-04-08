<div class="modal fade bs-example-modal-lg" id="modalCadCurso" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h4 class="modal-title"><i class="fa fa-book"></i> Cadastre Um Curso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="statusCadCurso" role="alert"></div>
                <form id="formStoreCurso" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nome do Curso:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCurso"
                                   placeholder="Informe o nome do Curso" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Professor do Curso:</label>
                        <div class="col-sm-5">
                            <select name="professor_id" class="form-control" id="inputProf">
                                @if(count(\App\Professor::all()) > 0)
                                    @foreach(\App\Professor::all() as $professor)
                                        <option value="{{$professor->id}}">{{$professor->nome}}</option>
                                    @endforeach
                                @else
                                    <option value="null">Não Informado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Descrição:</label>
                        <div class="col-sm-10">
                                <textarea name="descricao" class="form-control" id="inputDesc" cols="30" rows="10"
                                          placeholder="Insira informações sobre o Curso" required></textarea>
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

<div class="modal fade bs-example-modal-lg" id="modalEditCurso" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h4 class="modal-title"><i class="fa fa-book"></i> Editar Curso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="statusEditCurso" role="alert"></div>
                <form id="formEditCurso" class="form-horizontal">
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
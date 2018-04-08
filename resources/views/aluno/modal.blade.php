<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modalInscAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Inscreva-se Já</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div id="status" role="alert"></div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                       <div class="form-group" id="groupCPF">
                           <label for="exampleInputEmail1">Informe seu CPF:</label>
                           <input type="hidden" id="curso_id" value="{{$curso->id}}">
                           <input type="text" class="form-control" id="cpf" placeholder="Informe seu CPF">
                       </div>
                   </div>
                    <div class="col-md-8 col-md-offset-2" id="area">
                        <form id="inscForm"></form>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-slide-in-right" aria-hidden="true"
 role="dialog" tabindex="-1" id="modall-delete-{{$clien->idClientes}}">
    {{Form::open(array('action'=>array('ClientesController@cambio',$clien->idClientes),'method'=>'get'))}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="madal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Cambiar Estatus</h4>
        </div>
        <div class="modal-body">
          <p>Confirme si desea cambiar el estado del cliente</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
      </div>
    </div>

    {{Form::close()}}
</div>

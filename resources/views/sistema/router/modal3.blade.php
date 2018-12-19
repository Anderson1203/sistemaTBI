<div class="modal fade modal-slide-in-right" aria-hidden="true"
 role="dialog" tabindex="-1" id="modal3-delete-{{$rou->idRouter}}-{{$rou->idZona}}">


{{Form::open(array('action'=>array('ClientesController@creacorte',$rou->idRouter,$rou->idZona),'method'=>'get'))}}
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" action="index.html" method="post">
        <div class="madal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
            <span aria-hidden="true">x</span>
          </button>
            <h4 class="modal-title">Crear Cortes </h4>
          </div>
        <div class="modal-body">
          <p>Confirme si desea crear los cortes del router {{$rou->Nombre}} con los dias de pago {{$rou->idZona}} </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
        </form>
      </div>
    </div>
{{Form::close()}}
</div>

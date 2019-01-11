@extends('layouts.admin')
@section('contenido')

<div class="row">
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <h3>Listado De Clientes <a href="clientes/create"> <button class="btn btn-success">Nuevo</button> </a></h3>
     @include('sistema.clientes.search')
   </div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="r">Dia de pago</label>
      <select  name="IdRouter" class="form-control selec-router" onchange="onSelectClientChange()" >
         @foreach($clientes2 as $clien2)
          <option value="{{$clien2->idZona}}">{{$clien2->idZona}}</option>
          @endforeach
      </select>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="r">Crear Facturas</label>
      <div class="">

          <a href="{{URL::action('FacturaController@createClientes',$clien2->idZona)}}"><button class="btn btn-warning" title="Generar factura"><span class="fa fa-refresh" ></span></button></a>
      </div>
    </div>
  </div>
</div>

<div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="table-responsive">
       <table class="table table-striped table-bordered table-condensed table-hover">
         <thead>
           <th>Dia de Pago</th>
           <th>Router</th>
           <th>Plan</th>
           <th>Nombre</th>
           <th>Direccion</th>
           <th>Estatus</th>
           <th>Contraseña</th>
           <th>Opciones</th>
         </thead>
         @foreach($clientes as $clien)
         <tr>
           <td>{{$clien->idZona}}</td>
           <td>{{$clien->routers}}</td>
           <td>{{$clien->planess}}</td>
           <td>{{$clien->Nombre}}&nbsp &nbsp{{$clien->ApellidoP}}&nbsp &nbsp{{$clien->ApellidoM}}</td>
           <td>{{$clien->Direccion}}</td>
           <td>{{$clien->Estatus}}</td>
           <td>{{$clien->Referencia}}</td>
           <td>
             <a href="{{URL::action('ClientesController@edit',$clien->idClientes)}}"> <button class="btn btn-info" title="Editar"><span class="fa fa-pencil-square-o"></span></button></a>
             <a href="" data-target="#modal-delete-{{$clien->idClientes}}" data-toggle="modal"> <button class="btn btn-danger" title="Eliminar"><span class="fa fa-trash" ></span> </button></a>
             <a href="{{URL::action('FacturaController@createCliente',$clien->idClientes)}}"><button class="btn btn-warning" title="Generar factura"><span class="fa fa-refresh" ></span></button></a>
             @if("Activo"==$clien->Estatus)
              <a href="#" data-target="#modall-delete-{{$clien->idClientes}}" data-toggle="modal"> <button  class="btn btn-success" title="Desactivar"><span class="fa fa-power-off" ></span> </button></a>

              @else<a href="#" data-target="#modall-delete-{{$clien->idClientes}}" data-toggle="modal"> <button  class="btn btn-danger" title="Activar "><span class="fa fa-power-off" ></span> </button></a>

             @endif
           </td>
         </tr>
         @include('sistema.clientes.modal')
         @include('sistema.clientes.modal2')
         @endforeach
       </table>
     </div>


     <!-- <script type="text/javascript">

     function onSelectPend(){
       $('#pendien').on('change');
       var pendientess = $("#pendien").find(':selected').val();
       $.get('/api/proyectos/'+pendientess+'/cortes',function(data){
         alert(data);
       });
       console.log(pendientess);
     }
     </script> -->
     {{$clientes->render()}}
   </div>
</div>
@endsection

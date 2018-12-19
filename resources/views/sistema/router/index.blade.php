@extends ('layouts.admin')
@section ('contenido')
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<h3>Listado de Router<a href="router/create"><button class="btn btn-default">Nuevo</button></a></h3>
     		@include('sistema.router.search')
     	</div>
     </div>
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<div class="table-responsive">
     			 <table class="table table-striped table-bordered table-condensed table-hover">
     			 	<thead>
     			 		<th>Nombre</th>
     			 		<th>IP</th>
     			 		<th>UsuarioRB</th>
                              <th>PuertoApi</th>
     			 		<th>Dia Del Pago</th>
     			 		<th>Accion</th>
     			 	</thead>

     			 	@foreach ($routers as $rou)
     			 	<tr>
     			 		<td>{{$rou->Nombre}}</td>
     			 		<td>{{$rou->IP}}</td>
     			 		<td>{{$rou->UsuarioRB}}</td>
     			 		<td>{{$rou->PuertoApi}}</td>
              <td>{{$rou->idZona}}</td>
     			 		<td>
     			 			<a href="{{URL::action('RouterController@edit',$rou->idRouter)}}"><button class="btn btn-info" title="Editar"><span class="fa fa-pencil-square-o"></button></a>
                <a href="" data-target="#modal-delete-{{$rou->idRouter}}" data-toggle="modal"><button class="btn btn-danger" title="Eliminar"><span class="fa fa-trash" ></span></button></a>
                <a href="" data-target="#modal3-delete-{{$rou->idRouter}}-{{$rou->idZona}}" data-toggle="modal"><button class="btn btn-success" title="Cortes"><span class="fa fa-pencil" ></span></button></a>
              </td>
     			 	</tr>
     			 	@include('sistema.router.modal')
            @include('sistema.router.modal3')
     			 	@endforeach
     			 </table>
     		</div>
     		{{$routers->render()}}
     	</div>
     </div>
@endsection

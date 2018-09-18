@extends ('layouts.admin')
@section ('contenido')
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<h3>Listado de planes<a href="plan/create"><button class="btn btn-default">Nuevo</button></a></h3>
     		@include('sistema.plan.search')
     	</div>
     </div>
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<div class="table-responsive">
     			 <table class="table table-striped table-bordered table-condensed table-hover">
     			 	<thead>
     			 		<th>Nombre</th>
     			 		<th>Precio</th>
     			 		<th>Velocidad</th>
     			 		<th>Subida</th>
     			 		<th>Descripcion</th>
     			 		<th>Accion</th>
     			 	</thead>

     			 	@foreach ($planes as $pl)
     			 	<tr>
     			 		<td>{{$pl->Nombre}}</td>
     			 		<td>{{$pl->Precio}}</td>
     			 		<td>{{$pl->Velocidad}}</td>
     			 		<td>{{$pl->Subida}}</td>
     			 		<td>{{$pl->Descripcion}}</td>
     			 		<td>
     			 			<a href="{{URL::action('PlanController@edit',$pl->idPlanes)}}"><button class="btn btn-info">Editar</button></a>
     			 			<a href="" data-target="#modal-delete-{{$pl->idPlanes}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
     			 		</td>
     			 	</tr>
     			 	@include('sistema.plan.modal')
     			 	@endforeach
     			 </table>
     		</div>
     		{{$planes->render()}}
     	</div>
     </div>
@endsection
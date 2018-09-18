@extends ('layouts.admin')
@section ('contenido')
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<h3>Lista de Factura Pendientes</h3>
     		@include('sistema.pagof.search')
     	</div>
     </div>
     <div class="row">
     	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-15">
     		<div class="table-responsive">
     			 <table class="table table-striped table-bordered table-condensed table-hover">
     			 	<thead>
     			 		<th>Cliente</th>
     			 		<th>Zona</th>
     			 		<th>Forma de Pago</th>
     			 		<th>Fecha de Pago</th>
                              <th>Fecha de emision</th>
                              <th>Fecha de vencimiento</th>
                              <th>Estado</th>
                              <th>Tipo</th>
                              <th>Total</th>
     			 		<th>Accion</th>
     			 	</thead>

     			 	@foreach ($pagosf as $fac)
     			 	<tr>
     			 		<td>{{$fac->cliente}}</td>
     			 		<td>{{$fac->zona}}</td>
     			 		<td>{{$fac->nombre}}</td>
     			 		<td>{{$fac->FechaPago}}</td>
     			 		<td>{{$fac->FechaEmision}}</td>
                              <td>{{$fac->FechaVenci}}</td>
                              <td>{{$fac->Estado}}</td>
                              <td>{{$fac->Tipo}}</td>
                              <td>{{$fac->Total}}</td>
     			 		<td>
     			 			<a href="{{URL::action('PagosfController@edit',$fac->idFactura)}}"><button class="btn btn-info">Editar</button></a>
                                  
     			 		</td>
     			 	</tr>
     			 	
     			 	@endforeach
     			 </table>
     		</div>
     		{{$pagosf->render()}}
     	</div>
     </div>
@endsection
@extends ('layouts.admin')
@section ('contenido')
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<h3>Lista de Factura</h3>
     		@include('sistema.factura.search')
     	</div>
     </div>
     <div class="row">
     	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-15">
     		<div class="table-responsive">
     			 <table class="table table-striped table-bordered table-condensed table-hover">
     			 	<thead>
     			 		<th>Cliente</th>
     			 		<th>DP</th>
     			 		<th>Forma de Pago</th>
     			 		<th>Fecha de Pago</th>
                              <th>Fecha de emision</th>
                              <th>Fecha de vencimiento</th>
                              <th>Estado</th>
                              <th>Tipo</th>
                              <th>Total</th>
     			 		<th>Accion</th>
     			 	</thead>

     			 	@foreach ($facturas as $fac)
     			 	<tr>
     			 		<td>{{$fac->cliente}} {{$fac->AP}} {{$fac->AM}}</td>
     			 		<td>{{$fac->idZona}}</td>
     			 		<td>{{$fac->nombre}}</td>
     			 		<td>{{$fac->FechaPago}}</td>
     			 		<td>{{$fac->FechaEmision}}</td>
                              <td>{{$fac->FechaVenci}}</td>
                              <td>{{$fac->Estado}}</td>
                              <td>{{$fac->Tipo}}</td>
                              <td>{{$fac->Total}}</td>
     			 		<td>
     			 			<a href="{{URL::action('FacturaController@edit',$fac->idFactura)}}"><button title="Editar" class="btn btn-info"><span class="fa fa-pencil-square-o"></span></button></a>
                <a href="" data-target="#modal-delete-{{$fac->idFactura}}" data-toggle="modal"><button title="Eliminar" class="btn btn-danger"> <span class="fa fa-trash" ></span></button></a>
     			 		</td>
     			 	</tr>
     			 	@include('sistema.factura.modal')
     			 	@endforeach
     			 </table>
     		</div>
     		{{$facturas->render()}}
     	</div>
     </div>
@endsection

@extends ('layouts.admin')
@section ('contenido')
     <div class="row">
     	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     		<h3>Lista de Pagos</h3>
     		@include('sistema.pagos.search')
     	</div>
     </div>
     <div class="row">
     	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-15">
     		<div class="table-responsive">
     			 <table class="table table-striped table-bordered table-condensed table-hover">
     			 	<thead>
     			 		<th>Cliente</th>
              <th>Pago</th>
     			 	</thead>

     			 	@foreach ($usuario as $usu)
     			 	<tr>
     			 		<td>{{$usu->Nombreu}}&nbsp &nbsp{{$usu->ApellidoPP}}&nbsp &nbsp{{$usu->ApellidoMM}}</td>

     			 		<td> <img src='data:image/jpg;base64,". base64_encode($us->Imagen)."'></td>


     			 	</tr>

     			 	@endforeach
     			 </table>
     		</div>
     		{{$usuario->render()}}
     	</div>
     </div>
@endsection

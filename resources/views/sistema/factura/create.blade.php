@extends('layouts.admin')
@section('contenido')
     <div class="row">
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @foreach($clientes as $clie)
     		<h3>Factura {{$clie->Nombre}}</h3>
        @endforeach
     		@if (count($errors)>0)
     		<div class="alert alert-danger">
     			<ul>
     				@foreach ($errors->all() as $error)
     				<li>{{$error}}</li>
     				@endforeach
     			</ul>
     		</div>
     		@endif
     		{!!Form::open(array('url'=>'sistema/factura','method'=>'POST','autocomplete'=>'off'))!!}
     		{{Form::token()}}
     		<div class="form-group">
                    <label for="cliente">Cliente</label>
                       
                    <select name="IdCliente" disabled="disabled" class="form-control" id="selec-client" onclick="true">
                         @foreach($clientes as $clien)

                             <option value="{{$clien->idClientes}}">{{$clien->Nombre}}</option>
                         @endforeach
                    </select>
               </div>

               <div class="form-group">
                    <label for="zona">Zona</label>
                    <select name="idZona" class="form-control" disabled="disabled" id="selec-zon">
                      @foreach($zonas as $zones)
                          <option value="{{$zones->idZona}}" >{{$zones->Nombre}}</option>
                      @endforeach
                    </select>
               </div>


               <div class="form-group">
                    <label for="formas">Forma de Pago</label>
                    <select name="FormaP" class="form-control">
                         @foreach($formas as $fp)
                          <option value="{{$fp->idRegistroPago}}">{{$fp->Nombre}}</option>
                         @endforeach
                    </select>
               </div>

               <div class="form-group">
                    <label for="fece">Fecha de Emision</label>
                    <input type="date" name="FechaEmision" class="form-control" placeholder="FechaEmision..." value="<?php echo date("Y-m-d");?>" >
               </div>
               <script>
                 var fecha = new Date($('#fecp').val());
                 var dias = 2; // Número de días a agregar
                 fecha.setDate(fecha.getDate() + dias);
                 console.info(fecha)
               </script>

          <div class="form-group">
                    <label for="fecp">Fecha de Pago</label>
                    <input type="date" name="FechaPago" class="form-control" placeholder="FechaPago..." id="fecp" value="1999-12-1">
               </div>

               <div class="form-group">
                    <label for="fecv">Fecha de Vencimiento</label>
                    <input type="date" name="FechaVenci" class="form-control" placeholder="FechaVenci..." value="">
               </div>

     		<div class="form-group">
     			<label for="estado">Estado</label>
                    <select name="Estado" class="form-control">
                     <option value="Pendiente">Pendiente de pago</option>
                     <option value="Pagada">Pagada</option>
                     <option value="Cancelada">Cancelada</option>
                     <option value="Revision">En revision</option>
                     <option value="Transferida">Se transfirio</option>
                    </select>
     		</div>

               <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" name="Tipo" class="form-control" placeholder="Tipo...">
               </div>

               <div class="form-group">
                    <label for="total">Total</label>
                    @foreach($planes as $pl)
                    <input value="{{$pl->Precio}}" type="number" name="Total" class="form-control" placeholder="Total...">
                    @endforeach
               </div>

     		<div class="form-group">
     			<button class="btn btn-primary" type="submit">Guardar</button>
     			<button class="btn btn-danger" type="reset">Cancelar</button>
     		</div>

     		{!!Form::close()!!}
     	</div>
     </div>

@endsection

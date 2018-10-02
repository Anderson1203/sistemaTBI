@extends('layouts.admin')
@section('contenido')
     <div class="row">
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @foreach($clientes as $clie)
        @foreach($zonas as $zo)
     		<h3>Factura de {{$clie->Nombre}} {{$clie->ApellidoP}} {{$clie->ApellidoM}}</h3>
        <h3>Zona: {{$zo->Nombre}}</h3>
        @endforeach
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
      </div>
    </div>
     		{!!Form::open(array('url'=>'sistema/factura','method'=>'POST','autocomplete'=>'off'))!!}
     		{{Form::token()}}

      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
             <label style="display:none;" for="cliente">Cliente</label>

             <select style="display:none;" name="IdCliente" class="form-control" id="selec-client" onclick="true">
                  @foreach($clientes as $clien)

                      <option  value="{{$clien->idClientes}}">{{$clien->Nombre}}</option>
                  @endforeach
             </select>
           </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
               <label style="display:none;" for="zona">Zona</label>
               <select style="display:none;" name="idZona" class="form-control" id="selec-zon">
                 @foreach($zonas as $zones)
                     <option value="{{$zones->idZona}}">{{$zones->Nombre}}</option>
                 @endforeach
               </select>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
               <label for="formas">Forma de Pago</label>
               <select name="FormaP" class="form-control">
                    @foreach($formas as $fp)
                     <option value="{{$fp->idRegistroPago}}">{{$fp->Nombre}}</option>
                    @endforeach
               </select>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
                    <label for="fecp">Fecha de Pago</label>
                    <input type="date" name="FechaPago" class="form-control" placeholder="FechaPago..." value="<?php echo date("Y-m-d",strtotime("+ 3 days")); ?>" >
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
               <label for="fece">Fecha de Emision</label>
               <input type="date" name="FechaEmision" class="form-control" placeholder="FechaEmision..." value="<?php echo date("Y-m-d");?>" >
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
               <label for="fecv">Fecha de Vencimiento</label>
               <input type="date" name="FechaVenci" class="form-control" placeholder="FechaVenci..." value="<?php echo date("Y-m-d",strtotime("+ 4 days")); ?>">
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
               <label for="tipo">Tipo de plan</label>
               @foreach($planes as $pl)
               <input value="{{$pl->Nombre}}" type="text" name="Tipo" class="form-control" placeholder="Tipo...">
               @endforeach
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="form-group">
               <label for="total">Total</label>
               @foreach($planes as $pl)
               <input value="{{$pl->Precio}}" type="text" name="Total" class="form-control" placeholder="Total...">
               @endforeach
          </div>
        </div>


      </div>

     		<div class="form-group">
     			<button class="btn btn-primary" type="submit">Guardar</button>
     			<button class="btn btn-danger" type="reset">Cancelar</button>
     		</div>

     		{!!Form::close()!!}


@endsection

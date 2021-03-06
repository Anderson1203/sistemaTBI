@extends('layouts.admin')
@section('contenido')
     <div class="row">
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     		<h3>Nuevo plan</h3>
     		@if (count($errors)>0)
     		<div class="alert alert-danger">
     			<ul>
     				@foreach ($errors->all() as $error)
     				<li>{{$error}}</li>
     				@endforeach
     			</ul>
     		</div>
     		@endif
     		{!!Form::open(array('url'=>'sistema/plan','method'=>'POST','autocomplete'=>'off'))!!}
     		{{Form::token()}}
     		<div class="form-group">
     			<label for="nombre">Nombre</label>
     			<input type="text" name="Nombre" class="form-control" placeholder="Nombre...">
     		</div>


     		<div class="form-group">
     			<label for="precio">Precio</label>
     			<input type="number" name="Precio" class="form-control" placeholder="$">
     		</div>


     		<div class="form-group">
     			<label for="velocidad">Velocidad</label>
     			<input type="text" name="Velocidad" class="form-control" placeholder="velocidad...">
     		</div>

     		<div class="form-group">
     			<label for="subida">Subida</label>
     			<input type="text" name="Subida" class="form-control" placeholder="subida...">
     		</div>

     		<div class="form-group">
     			<label for="descripcion">Descripcion</label>
     			<input type="text" name="Descripcion" class="form-control" placeholder="Descripcion...">
     		</div>

     		<div class="form-group">
     			<button class="btn btn-primary" type="submit">Guardar</button>
     			<button class="btn btn-danger" type="reset">Cancelar</button>
     		</div>

     		{!!Form::close()!!}
     	</div>
     </div>
@endsection
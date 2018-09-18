@extends('layouts.admin')
@section('contenido')
     <div class="row">
     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     		<h3>Editar plan:{{$plan->Nombre}}</h3>
     		@if (count($errors)>0)
     		<div class="alert alert-danger">
     			<ul>
     				@foreach ($errors->all() as $error)
     				<li>{{$error}}</li>
     				@endforeach
     			</ul>
     		</div>
     		@endif
     		{!!Form::model($plan,['method'=>'PATCH','route'=>['plan.update',$plan->idPlanes]])!!}
     		{{Form::token()}}
     		<div class="form-group">
     			<label for="nombre">Nombre</label>
     			<input type="text" name="Nombre" class="form-control" placeholder="Nombre..." value="{{$plan->Nombre}}">
     		</div>


     		<div class="form-group">
     			<label for="precio">Precio</label>
     			<input type="number" name="Precio" class="form-control" placeholder="$" value="{{$plan->Precio}}">
     		</div>


     		<div class="form-group">
     			<label for="velocidad">Velocidad</label>
     			<input type="text" name="Velocidad" class="form-control" placeholder="velocidad..." value="{{$plan->Velocidad}}">
     		</div>

     		<div class="form-group">
     			<label for="subida">Subida</label>
     			<input type="text" name="Subida" class="form-control" placeholder="subida..." value="{{$plan->Subida}}">
     		</div>

     		<div class="form-group">
     			<label for="descripcion">Descripcion</label>
     			<input type="text" name="Descripcion" class="form-control" placeholder="Descripcion..." value="{{$plan->Descripcion}}">
     		</div>

     		<div class="form-group">
     			<button class="btn btn-primary" type="submit">Guardar</button>
     			<button class="btn btn-danger" type="reset">Cancelar</button>
     		</div>

     		{!!Form::close()!!}
     	</div>
     </div>
@endsection
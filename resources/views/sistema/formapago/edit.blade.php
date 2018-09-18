@extends('layouts.admin')
@section('contenido')
     <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
         <h3>Editar Forma De Pago {{$formapago->Nombre}}</h3>
         @if(count($errors)>0)
         <div class="alert alert-danger">
           <ul>
             @foreach($errors->all() as $error)
             <li>{{$error}}</li>
             @endforeach
           </ul>
         </div>
         @endif

         {!!Form::model($formapago,['method'=>'PATCH','route'=>['formapago.update',$formapago->idRegistroPago]])!!}
          {{Form::token()}}
          <div class="form-group">
            <label for="Nombre">Nombre</label>
            <input type="text" name="Nombre" class="form-control" value="{{$formapago->Nombre}}" placeholder="Nombre..">
          </div>
          <div class="form-group">
            <label for="Descripcion">Descripcion</label>
            <input type="text" name="Descripcion" class="form-control" value="{{$formapago->Descripcion}}" placeholder="Descripcion..">
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
         {!!Form::close()!!}

       </div>
     </div>
@endsection
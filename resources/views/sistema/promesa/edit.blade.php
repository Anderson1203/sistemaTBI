@extends('layouts.admin')
@section('contenido')
     <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
               <h3> Registrar promesa de pago </h3>
               @if (count($errors)>0)
               <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                         <li>{{$error}}</li>
                         @endforeach
                    </ul>
               </div>
               @endif
               {!!Form::model($promesa,['method'=>'PATCH','route'=>['promesa.update',$promesa->idFactura]])!!}
               {{Form::token()}}
                
               <div class="tab-content">
                   

               <div class="form-group">

                    <label for="fecv">Promesa de pago </label>
                    <input type="date" name="FechaVenci" class="form-control" placeholder="..." value="{{$promesa->FechaVenci}}">
               </div>

                  

               <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
               </div>

               </div>
     
               {!!Form::close()!!}
          </div>
     </div>
@endsection
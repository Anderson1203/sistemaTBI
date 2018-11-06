@extends('layouts.admin')
@section('contenido')
     <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <h3> Registrar Pago </h3>
               @if (count($errors)>0)
               <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                         <li>{{$error}}</li>
                         @endforeach
                    </ul>
               </div>
               @endif
               {!!Form::model($pago,['method'=>'PATCH','route'=>['pagofactura.update',$pago->idFactura]])!!}
               {{Form::token()}}

               <div class="tab-content">


               <div class="form-group">

                    <label for="fecv">Monto a Pagar</label>
                    <input type="number" name="mnt" class="form-control" disabled="disabled" placeholder="..." value="{{$pago->Total}}">

                    <label for="">Cantidad que abonara</label>
                    <input type="number" name="Total" class="form-control" placeholder="..." value="{{$pago->Total}}">
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

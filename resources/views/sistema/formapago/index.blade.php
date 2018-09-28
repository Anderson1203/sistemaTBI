@extends('layouts.admin')
@section('contenido')
     <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Listado De Formas De Pago <a href="formapago/create"> <button class="btn btn-default">Nuevo</button> </a></h3>
          @include('sistema.formapago.search')
        </div>
     </div>
     <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Opciones</th>
              </thead>
              @foreach($formapago as $forma)
              <tr>
                <td>{{$forma->idRegistroPago}}</td>
                <td>{{$forma->Nombre}}</td>
                <td>{{$forma->Descripcion}}</td>
                <td>
                  <a href="{{URL::action('FormaPagoController@edit',$forma->idRegistroPago)}}"> <button class="btn btn-info">Editar </button></a>
                  <a href="" data-target="#modal-delete-{{$forma->idRegistroPago}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar </button></a>
                </td>
              </tr>
              @include('sistema.formapago.modal')
              @endforeach
            </table>
          </div>
          {{$formapago->render()}}
        </div>
     </div>
@endsection

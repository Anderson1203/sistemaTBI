@extends('layouts.admin')
@section('contenido')
<div class="row">
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <h3>Listado De Zonas <a href="zona/create"> <button class="btn btn-default">Nuevo</button> </a></h3>
     @include('sistema.zona.search')
   </div>
</div>

<div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="table-responsive">
       <table class="table table-striped table-bordered table-condensed table-hover">
         <thead>
           <th>Nombre</th>
           <th>Cantidad</th>
           <th>Opciones</th>
         </thead>
         @foreach($zona as $z)
            <tr>
              <td>{{$z->Nombre}}</td>
              <td></td>
              <td>
                <a href="{{URL::action('ZonaController@edit',$z->idZona)}}"> <button class="btn btn-info" title="Editar"><span class="fa fa-pencil-square-o"></span></button></a>
                <a href="" data-target="#modal-delete-{{$z->idZona}}" data-toggle="modal"> <button class="btn btn-danger"title="Eliminar"><span class="fa fa-trash" ></span></button></a>
              </td>
            </tr>
            @include('sistema.zona.modal')
            </tr>
         @endforeach
       </table>
     </div>
     {{$zona->render()}}
   </div>
</div>
@endsection

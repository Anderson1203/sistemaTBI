@extends('layouts.admin')
@section('contenido')
<div class="row">
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <h3>Listado De Clientes <a href="clientes/create"> <button class="bnt btn-default">Nuevo</button> </a></h3>
     @include('sistema.clientes.search')
   </div>
</div>
<div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="table-responsive">
       <table class="table table-striped table-bordered table-condensed table-hover">
         <thead>
           <th>Zona</th>
           <th>Router</th>
           <th>Plan</th>
           <th>Nombre</th>
           <th>Direccion</th>
           <th>Opciones</th>
         </thead>
         @foreach($clientes as $clien)
         <tr>

           <td>{{$clien->zonas}}</td>
           <td>{{$clien->routers}}</td>
           <td>{{$clien->planess}}</td>
           <td>{{$clien->Nombre}}&nbsp &nbsp{{$clien->ApellidoP}}&nbsp &nbsp{{$clien->ApellidoM}}</td>
           <td>{{$clien->Direccion}}</td>
           <td>
             <a href="{{URL::action('ClientesController@edit',$clien->idClientes)}}"> <button class="btn btn-info">Editar </button></a>
             <a href="" data-target="#modal-delete-{{$clien->idClientes}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar </button></a>
           </td>
         </tr>
         @include('sistema.clientes.modal')
         @endforeach
       </table>
     </div>
   </div>
</div>
@endsection

@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h3>Nuevo Cliente</h3>
    @if(count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
</div>

    {!!Form::open(array('url'=>'sistema/clientes','method'=>'POST','autocomplete'=>'off'))!!}
     {{Form::token()}}
     <div class="">
       <ul class="nav nav-tabs">
         <li class="active"><a href="#DatosClien" data-toggle="tab">Datos De Clientes</a></li>
         <li><a href="#DatosC" data-toggle="tab">Datos Del Conexion</a></li>
       </ul>
     </div>

<div class="tab-content">
  <div class="tab-pane fade" id="DatosC">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="z">Zonas</label>
          <select  name="IdZona" class="form-control">
            @foreach($zona as $zon)
            <option  value="{{$zon->idZona}}">{{$zon->Nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="r">Router</label>
          <select  name="IdRouter" class="form-control">
            @foreach($router as $rou)
            <option  value="{{$rou->idRouter}}">{{$rou->Nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="p">Planes</label>
          <select  name="IdPlanInt"class="form-control">
            @foreach($planes as $plan)
            <option  value="{{$plan->idPlanes}}">{{$plan->Nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="NombreC">Nombre Conexion</label>
          <input type="text" name="NombreConec"  class="form-control" placeholder="Nombre Conexion..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="Ip">Ip</label>
          <input type="text" name="Ip"  class="form-control" placeholder="Ip..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="MAc">MacCP</label>
          <input type="text" name="MacCp"  class="form-control" placeholder="MacCp..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="Coordenada">Coordenada</label>
          <input type="text" name="Coordenada"  class="form-control" placeholder="Coordenada..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="Estatus">Estatus</label>
          <select class="form-control" name="Estatus">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
          </select>
        </div>
      </div>
    </div>

  <div class="row">
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <button class="btn btn-danger" type="reset">Cancelar</button>
    </div>
  </div>

  </div>

  <div class="tab-pane fade in active" id="DatosClien">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="Nombre">Nombre</label>
          <input type="text" name="Nombre"  class="form-control" placeholder="Nombre..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="ap">Apellido Paterno</label>
          <input type="text" name="ApellidoP"  class="form-control" placeholder="Apellido Paterno..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="am">Apellido Materno</label>
        <input type="text" name="ApellidoM"  class="form-control" placeholder="Apellido Materno..">
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="ce">Correo Electronico</label>
        <input type="email" name="Email"  class="form-control" placeholder="Correo Electronico..">
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="d">Direccion</label>
        <input type="text" name="Direccion"  class="form-control" placeholder="Direccion..">
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="T">Telefono</label>
          <input type="text" name="Telefono"  class="form-control" placeholder="Telefono..">
        </div>
      </div>
  </div>

  </div>

</div>

    {!!Form::close()!!}

@endsection

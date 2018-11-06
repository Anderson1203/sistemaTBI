@extends('layouts.admin')
@section('contenido')
<style> #map-canvas{
   width:500px;
   height:370px;
   }
 </style>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&libraries=places"
    type="text/javascript"></script>
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
<!-- Datos Del Cliente -->
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
        <input type="text" name="Direccion" id="searchmap"  class="form-control" placeholder="Direccion..">
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="T">Telefono</label>
          <input type="tel" name="Telefono" maxlength="10" class="form-control" placeholder="Telefono..">
        </div>
      </div>
  </div>


  </div>

  <!-- Datos De La Conexion -->
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
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="p">Referencia (opcional)</label>
          <input type="text" name="Referencia"  class="form-control" placeholder="Por si cuenta con dos o mas servicio">
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
          <input type="text" name="Ip" maxlength="15"  class="form-control" placeholder="Ip..">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="MAc">MacCP</label>
          <input id="numb" type="text" maxlength="17" name="MacCp"  class="form-control " placeholder="MacCp..">
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

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
          <label for="Coordenada">Coordenada</label>

          <input type="text" id="coor" name="Coord"  class="form-control" placeholder="Latitud.." >
          <input type="text" id="coor1" name="Coord1"  class="form-control" placeholder="Longitud.." >

          <div id="map-canvas"></div>
          <script>
            var map = new google.maps.Map(document.getElementById('map-canvas'),{
              center:{
                lat:14.9024043,
                lng:-92.2675923 },
                zoom:16
              });
              var marker= new google.maps.Marker({
                position:{
                  lat:14.9024043,
                  lng:-92.2675923 },
                  map:map,
                  draggable:true
                });
              var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
              google.maps.event.addListener(searchBox,'places_changed',function(){
              var places = searchBox.getPlaces();
              var bounds = new google.maps.LatLngBounds();
              var i , place; for(i=0;place=places[i];i++){
                bounds.extend(place.geometry.location);
                 marker.setPosition(place.geometry.location);
               }
                 map.fitBounds(bounds);
                 map.setZoom(16);
               });
                 google.maps.event.addListener(marker,'position_changed',
                 function(){
                   var lat = marker.getPosition().lat();
                   var lng = marker.getPosition().lng();
                   $('#coor').val(lat);
                   $('#coor1').val(lng);
                 });
          </script>

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




<script type="text/javascript" src="{{asset('js/separadores/create.js')}}">

</script>


</div>

    {!!Form::close()!!}


@endsection

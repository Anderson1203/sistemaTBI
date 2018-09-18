@extends('layouts.admin')
@section('contenido')
     <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
         <h3>Editar Zona {{$zona->Nombre}}</h3>
         @if(count($errors)>0)
         <div class="alert alert-danger">
           <ul>
             @foreach($errors->all() as $error)
             <li>{{$error}}</li>
             @endforeach
           </ul>
         </div>
       </div>
     </div>
         @endif


         {!!Form::model($zona,['method'=>'PATCH','route'=>['zona.update',$zona->idZona]])!!}
          {{Form::token()}}
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" value="{{$zona->Nombre}}" class="form-control" placeholder="Nombre..">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Tipo">Tipo</label>
                <select  name="Tipo" class="form-control">
                  <option value="{{$zona->Tipo}}" style="display:none">{{$zona->Tipo}}</option>
                  <option value="Prepago">Prepago</option>
                  <option value="Postpago">Postpago</option>
                </select>

              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" value="{{$zona->Descripcion}}" class="form-control" placeholder="Descripcion..">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Aviso">Tipo De Aviso</label>
                <select  name="Aviso" class="form-control">
                  <option value="{{$zona->Aviso}}" style="display:none">{{$zona->Aviso}}</option>
                  <option value="Correo">Correo</option>
                  <option value="CorreoMs">Correo + MS</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Fack">Crea Factura</label>
                <select  name="CreaFactura" class="form-control">
                  <option value="{{$zona->CreaFactura}}" style="display:none">{{$zona->CreaFactura}}</option>
                  <option value="1">3 Dias antes de cada 1 del mes</option>
                  <option value="15">3 Dias antes de 15 de cada mes</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Hora1">.</label>

                  <input value="{{$zona->Hora1}}"  type="time" name="Hora1">

              </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="DiaP">Dia pago</label>
                <select  name="DiaPago" class="form-control">
                  <option value="{{$zona->DiaPago}}" style="display:none">{{$zona->DiaPago}}</option>
                  <option value="1">Dia 1 del mes</option>
                  <option value="15">Dia 15 del mes</option>
                </select>
              </div>
            </div>

          </div>

          <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="RecorP">Recordatorio de pago en pantalla</label>
                  <select  name="Recordar" class="form-control">
                    <option value="{{$zona->Recordar}}" style="display:none">{{$zona->Recordar}}</option>
                    <option value="1">3 Dias antes de cada 1 del mes</option>
                    <option value="15">3 Dias antes de 15 de cada mes</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="Hora2">.</label>

                    <input value="{{$zona->Hora2}}" type="time" name="Hora2">

                </div>

              </div>

          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Redorda1">Enviar recordatorio de pago en pantalla</label>
                <select  name="RecorPago" class="form-control">
                  <option value="{{$zona->RecorPago}}" style="display:none">{{$zona->RecorPago}}</option>
                  <option value="1">No</option>
                  <option value="2">Si</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Diac">Dia de corte</label>
                <select  name="CortePag" class="form-control">
                  <option value="{{$zona->CortePag}}" style="display:none">{{$zona->CortePag}}</option>
                  <option value="1">3 Dias antes de cada 1 del mes</option>
                  <option value="15">3 Dias antes de 15 de cada mes</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Hora3">.</label>

                  <input  value="{{$zona->Hora3}}" type="time" name="Hora3">

              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Supen">Suspender factura</label>
                <select  name="Suspender" class="form-control">
                  <option value="{{$zona->Suspender}}" style="display:none">{{$zona->Suspender}}</option>
                  <option value="1">Dia 1 del mes</option>
                  <option value="15">Dia 15 del mes</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Impu">Impuesto</label>
                  <input class="form-control" value="{{$zona->Impuesto}}" type="number" name="Impuesto">
              </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Mone">Moneda</label>
                <select  name="Moneda" class="form-control">
                  <option value="{{$zona->Moneda}}" style="display:none">{{$zona->Moneda}}</option>
                  <option value="1" selected="selected">Peso Méxicano</option>
                    <option value="2">Peso Chileno</option>
                    <option value="3">Euro</option>
                    <option value="4">Ecuador</option>
                    <option value="5">Peso Argentino</option>
                    <option value="6">Soles</option>
                    <option value="7">Bolivar</option>
                    <option value="8">Dolares US</option>
                    <option value="9">Peso Republica Dominicana</option>
                    <option value="10">Peso Colombia</option>
                    <option value="11">Costa Rica (Colon)</option>
                    <option value="12">Honduras(Lempira)</option>
                    <option value="13">Guatemala(Quetzal)</option>
                    <option value="14">Boliviano</option>
                    <option value="15">Peso Paraguay(Guaraní)</option>
                </select>
              </div>
            </div>
          </div>
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
         {!!Form::close()!!}

@endsection

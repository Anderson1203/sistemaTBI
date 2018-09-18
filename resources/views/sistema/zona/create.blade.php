@extends('layouts.admin')
@section('contenido')
     <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
         <h3>Nueva Zona</h3>
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


         {!!Form::open(array('url'=>'sistema/zona','method'=>'POST','autocomplete'=>'off'))!!}
          {{Form::token()}}
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre"  class="form-control" placeholder="Nombre..">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Tipo">Tipo</label>
                <select  name="Tipo" class="form-control">
                  <option value="Prepago">Prepago</option>
                  <option value="Postpago">Postpago</option>
                </select>

              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" class="form-control" placeholder="Descripcion..">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Aviso">Tipo De Aviso</label>
                <select  name="Aviso" class="form-control">
                  <option value="Correo">Correo</option>
                  <option value="CorreoMs">Correo + MS</option>
                </select>
              </div>
            </div>

            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Fack">Crea Factura</label>
                <select  name="CreaFactura" class="form-control">
                  <option value="1">3 Dias antes de cada 1 del mes</option>
                  <option value="15">3 Dias antes de 15 de cada mes</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Hora1">.</label>
                <input class="timepicker form-control" name="Hora1" type="text">

                <script type="text/javascript">
                $('.timepicker').datetimepicker({
                  format: 'HH:mm:ss'
                  });
                </script>
              </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="DiaP">Dia pago</label>
                <select  name="DiaPago" class="form-control">

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

                    <option value="1">3 Dias antes de cada 1 del mes</option>
                    <option value="15">3 Dias antes de 15 de cada mes</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="Hora2">.</label>

                  <input class="timepicker form-control" name="Hora2" type="text">

                  <script type="text/javascript">
                  $('.timepicker').datetimepicker({
                    format: 'HH:mm:ss'
                    });
                  </script>

                </div>

              </div>

          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Redorda1">Enviar recordatorio de pago en pantalla</label>
                <select  name="RecorPago" class="form-control">
                  <option value="No">No</option>
                  <option value="Si">Si</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Diac">Dia de corte</label>
                <select  name="CortePag" class="form-control">

                  <option value="1">3 Dias antes de cada 1 del mes</option>
                  <option value="15">3 Dias antes de 15 de cada mes</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Hora3">.</label>

                  <input class="timepicker form-control" name="Hora3" type="text">

                  <script type="text/javascript">
                  $('.timepicker').datetimepicker({
                    format: 'HH:mm:ss'
                    });
                  </script>

              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Supen">Suspender factura</label>
                <select  name="Suspender" class="form-control">

                  <option value="1">Dia 1 del mes</option>
                  <option value="15">Dia 15 del mes</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Impu">Impuesto</label>
                  <input class="form-control"type="number" name="Impuesto">
              </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="Mone">Moneda</label>
                <select  name="Moneda" class="form-control">
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

          <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
         {!!Form::close()!!}

@endsection

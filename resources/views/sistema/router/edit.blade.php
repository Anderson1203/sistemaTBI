@extends('layouts.admin')
@section('contenido')
     <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <h3> Router a modificar {{$router->Nombre}}</h3>
               @if (count($errors)>0)
               <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                         <li>{{$error}}</li>
                         @endforeach
                    </ul>
               </div>
               @endif
             </div>
           </div>
               {!!Form::model($router,['method'=>'PATCH','route'=>['router.update',$router->idRouter]])!!}
               {{Form::token()}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="nombre">Nombre</label>
                   <input type="text" name="Nombre"  class="form-control" value="{{$router->Nombre}}" placeholder="Nombre...">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="ip">IP</label>
                   <input type="text" name="IP" class="form-control" placeholder="192.168....." value="{{$router->IP}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="usuariorb">UsuarioRB</label>
                   <input type="text" name="UsuarioRB" class="form-control" placeholder="UsuarioRB..." value="{{$router->UsuarioRB}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="passwordrb">PasswordRB</label>
                   <input type="text" name="PasswordRB" class="form-control" placeholder="PasswordRB..." value="{{$router->PasswordRB}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="puertoapi">Puerto Api</label>
                   <input type="text" name="PuertoApi" class="form-control" placeholder="PuertoApi..." value="{{$router->PuertoApi}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="zona">Zona</label>
                   <select name="idZona" class="form-control">
                        @foreach($zonas as $zon)
                        @if ($zon->idZona==$router->idZona)

                        <option value="{{$zon->idZona}}" selected>{{$zon->Nombre}}</option>
                        @else
                        <option value="{{$zon->idZona}}">{{$zon->Nombre}}</option>
                        @endif
                        @endforeach
                   </select>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="puertow">PuertoW</label>
                   <input type="text" name="PuertoW" class="form-control" placeholder="PuertoW..." value="{{$router->PuertoW}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="interfaz">Interfaz</label>
                   <input type="text" name="Interfaz" class="form-control" placeholder="Interfaz..." value="{{$router->Interfaz}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="rangos">Rangos</label>
                   <input type="text" name="Rangos" class="form-control" placeholder="Rangos..." value="{{$router->Rangos}}">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                   <label for="coordenadas">Coordenadas</label>
                   <input type="text" name="Coordenadas" class="form-control" placeholder="Coordenadas..." value="{{$router->Coordenadas}}">
              </div>
            </div>
        </div>

               <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
               </div>

               {!!Form::close()!!}
          </div>
     </div>
@endsection

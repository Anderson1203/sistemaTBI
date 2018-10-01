@extends('layouts.admin')
@section('contenido')
     <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
               <h3> Factura a modificar</h3>
               @if (count($errors)>0)
               <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                         <li>{{$error}}</li>
                         @endforeach
                    </ul>
               </div>
               @endif
               {!!Form::model($pagof,['method'=>'PATCH','route'=>['pagof.update',$pagof->idFactura]])!!}
               {{Form::token()}}
                
               <div class="tab-content">
                    <div class="form-group">
                    <label for="cliente">Cliente</label>
                    <select name="IdCliente" class="form-control">
                         @foreach($clientes as $clien)
                         @if ($clien->idClientes==$pagof->IdCliente)
                         <option value="{{$clien->idClientes}}" selected>{{$clien->Nombre}}</option>
                         @else
                         <option value="{{$clien->idClientes}}">{{$clien->Nombre}}</option>
                         @endif
                         @endforeach
                    </select>
               </div>

               <div class="form-group">
                    <label for="zona">Zona</label>
                    <select name="idZona" class="form-control">
                         @foreach($zonas as $zon)
                         @if ($zon->idZona==$pagof->IdZona)
                         <option value="{{$zon->idZona}}" selected>{{$zon->Nombre}}</option>
                         @else
                         <option value="{{$zon->idZona}}">{{$zon->Nombre}}</option>
                         @endif
                         @endforeach
                    </select>
               </div>

               <div class="form-group">
                    <label for="formas">Forma de Pago</label>
                    <select name="FormaP" class="form-control">
                         @foreach($formapagos as $fp)
                         @if ($fp->idRegistroPago==$pagof->FormaP)
                         <option value="{{$fp->idRegistroPago}}" selected>{{$fp->Nombre}}</option>
                         @else
                             <option value="{{$fp->idRegistroPago}}">{{$fp->Nombre}}</option>
                             @endif
                         @endforeach
                    </select>
               </div>

               <div class="form-group">
                    <label for="fecp">Fecha de Pago</label>
                    <input type="date" name="FechaPago" class="form-control" placeholder="FechaPago..." value="{{$pagof->FechaPago}}">
               </div>


               <div class="form-group">
                    <label for="fece">Fecha de Emision</label>
                    <input type="date" name="FechaEmision" class="form-control" placeholder="FechaEmision..." value="{{$pagof->FechaEmision}}">
               </div>

               <div class="form-group">
                    <label for="fecv">Fecha de Vencimiento</label>
                    <input type="date" name="FechaVenci" class="form-control" placeholder="FechaVenci..." value="{{$pagof->FechaVenci}}">
               </div>

                   <div class="form-group">
                    <label for="estado">Estado</label>
                     <select name="Estado" class="form-control">
                     <option value="{{$pagof->Estado}}" style="display:none">{{$pagof->Estado}}</option>               
                     <option value="Pendiente">Pendiente de pago</option>
                     <option value="Pagada">Pagada</option>   
                     <option value="Cancelada">Cancelada</option>
                     <option value="Revision">En revision</option>   
                     <option value="Transferida">Se transfirio</option>   
                    </select>
               </div>

               <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" name="Tipo" class="form-control" placeholder="Tipo..." value="{{$pagof->Tipo}}">
               </div>

               <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" name="Total" class="form-control" placeholder="Total..." value="{{$pagof->Total}}">
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
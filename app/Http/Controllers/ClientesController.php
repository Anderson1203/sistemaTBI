<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\Clientes;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\ClientesFormRequest;
use DB;
use Laracasts\Flash\Flash;
use Mail;
class ClientesController extends Controller
{
  public function __construct(){

  }

  public function index(Request $request){

    $query=trim($request->get('searchText'));
    		$clientes=DB::table('clientes as c')
            ->join('planes as p','c.IdPlanInt','=','p.idPlanes')
            ->join('router as r','c.IdRouter','=','r.idRouter')
            ->select('c.idClientes','c.idZona','p.Nombre as planess','r.Nombre as routers','c.Nombre','c.ApellidoP','c.ApellidoM','c.Direccion','c.Estatus','c.Referencia')
            ->where('c.Nombre','like','%'.$query.'%')
            ->orderBy('c.idClientes','desc')
            ->paginate(10);
      $router=DB::table('router')->get();
      $clientes2=DB::table('router')->select('idZona')->distinct()->get();
    		return view('sistema.clientes.index',["clientes"=>$clientes,"clientes2"=>$clientes2,"router"=>$router,"searchText"=>$query]);
     }

    public function byclient($id)
    {
     $id_zonaR=DB::table('router')
     ->where('idRouter','=',$id)
     ->select('IdZona')->get();

      $resultado =preg_replace("/[^0-9]/", "", $id_zonaR);

      $id_z=DB::table('zona')
     ->where('idZona','=',$resultado)
     ->select('IdZona','Nombre')->get();
     return $id_z;
    }

    public function creacorte($id,$id2){
      $APIM= new ApiRoutersController;
      $id_zonaR=DB::table('clientes')
      ->where('idZona','=',$id2)->count();

      $clientes=DB::table('clientes')
      ->where('idRouter','=',$id)->get();

      $facturas=DB::table('factura')->where('idZona','=',$id2)->get();

      $routers=DB::table('Router')->where('idRouter','=',$id);
      $IpRou=$routers->select('IP')->value('IP');
      $UsuRou=$routers->select('UsuarioRB')->value('UsuarioRB');
      $PasRou=$routers->select('PasswordRB')->value('PasswordRB');

      $APIM->debug = false;
      if($APIM->connect($IpRou,$UsuRou,$PasRou)){
        foreach ($facturas as $key => $value){
          foreach ($clientes as $key2 => $value2){
          // echo  $value->Nombre.' '.$value->Ip;
          $IpC=$value2->Ip;
          $NombreM=$value2->NombreConec;
          $nombreC='Moroso';
          if($value->Estado=='Pendiente' && $value->promesa==2){
            if($value2->Estatus=='Activo' && $value->IdCliente==$value2->idClientes) {
                $clientes2=Clientes::findOrFail($value2->idClientes);
                $clientes2->Estatus='Inactivo';
                   $APIM->write("/ip/firewall/address-list/getall",false);
                   $APIM->write('?address='.$IpC,false);
                   $APIM->write('?list='.$nombreC,true);
                   $READ = $APIM->read(false);
                   $ARRAY = $APIM->parseResponse($READ); // busco si ya existe
                    if(count($ARRAY)>0){
                        Flash::warning("Ya existe " . $nombreC." con la direccion: ".$IpC);
                    }else{ // si no existe lo creo
                        $APIM->write("/ip/firewall/address-list/add",false);
                        $APIM->write('=address='.$IpC,false);   // IP
                        $APIM->write('=list='.$nombreC,false);       // lista
                        $APIM->write('=comment='.$NombreM,true);  // comentario
                        $READ = $APIM->read(false);
                        $ARRAY = $APIM->parseResponse($READ);
                        $clientes2->update();
                        Flash::success("Se agrego la direccion " . $nombreC ." a la lista: ".$IpC);
                    }
                  }
                }
              }
            }
          }
        $APIM->disconnect();
        return Redirect::to('sistema/clientes');
    }


  public function create(){
    $zona=DB::table('zona')->get();
    $planes=DB::table('planes')->get();
    $router=DB::table('router')->get();
     return view("sistema.clientes.create",["zona"=>$zona,"planes"=>$planes,"router"=>$router]);
  }

  public function store(ClientesFormRequest $request){
  $clientes= new Clientes;
  $APIM= new ApiRoutersController;

  $co1=$request->get('Coord');
  $co2=$request->get('Coord1');
  $Coorde=$co1.$co2;
  $clientes->IdZona=$request->get('IdZona');
  $clientes->IdRouter=$request->get('IdRouter');
  $clientes->IdPlanInt=$request->get('IdPlanInt');
  $clientes->Nombre=$request->get('Nombre');
  $clientes->ApellidoP=$request->get('ApellidoP');
  $clientes->ApellidoM=$request->get('ApellidoM');
  $clientes->Email=$request->get('Email');
  $clientes->Direccion=$request->get('Direccion');
  $clientes->Telefono=$request->get('Telefono');
  $clientes->NombreConec=$request->get('NombreConec');
  $clientes->Ip=$request->get('Ip');
  $clientes->MacCp=$request->get('MacCp');
  $clientes->Coordenada=$Coorde;
  $clientes->Estatus=$request->get('Estatus');
  $clientes->SaldoF=0;
  $longitud = 8; // longitud del password
  $pass1 = substr(md5(rand()),0,$longitud);
  $clientes->Referencia=$pass1;


  $nombreC=$clientes->NombreConec;

  $planest=DB::table('planes')->where('idPlanes','=',$clientes->IdPlanInt)->select('Velocidad','Subida','Descripcion');

  $Velocidad=preg_replace("/[^0-9]/", "", $planest->select('Velocidad')->get());

  $Subida=preg_replace("/[^0-9]/", "", $planest->select('Subida')->get());
  $maxlimit=$Velocidad.'M'.'/'.$Subida.'M';

  $inforouter=DB::table('router')->where('idRouter','=',$clientes->IdRouter)->select('IP','UsuarioRB','PasswordRB');

  $DireccionIP= $inforouter->select('IP')->value('IP');
  $UsuarioRB1= $inforouter->select('UsuarioRB')->value('UsuarioRB');
  $Password= $inforouter->select('PasswordRB')->value('PasswordRB');

   $comment='';

          if( $clientes->Ip !="" ){
            $APIM->debug = false;
            if ($APIM->connect($DireccionIP,$UsuarioRB1,$Password)) {

                    $APIM->write("/queue/simple/add",false);
                    $APIM->write('=target='.$clientes->Ip,false);   // IP
                    $APIM->write('=name='.$nombreC,false);       // nombre
                    $APIM->write('=max-limit='.$maxlimit,false);   //   2M/2M   [TX/RX]
                    $APIM->write('=comment='.$comment,true);         // comentario
                    $READ = $APIM->read(false);
                    $ARRAY = $APIM->parseResponse($READ);
                    $clientes->save();

                  Flash::success("Se registro el cliente ". $clientes->Nombre ." Exitosamente");

                $APIM->disconnect();
            }
            else {
              Flash::error("Problema al conectarse al mikrotik");
            }
        }
        return Redirect::to('sistema/clientes');
  }

  public function show($id){
     return veiw ("sistema.clientes.show",["clientes"=>Clientes::findOrFail($id)]);
  }

  public function edit($id){
    $clientes=Clientes::findOrFail($id);
    $zona=DB::table('zona')->get();
    $planes=DB::table('planes')->get();
    $router=DB::table('router')->get();
    return view("sistema.clientes.edit",["clientes"=>$clientes,"zona"=>$zona,"planes"=>$planes,"router"=>$router]);
  }

  public function update(ClientesFormRequest $request,$id){
     $APIM= new ApiRoutersController;
     $clientes=Clientes::findOrFail($id);
     $co1=$request->get('Coord');
     $co2=$request->get('Coord1');
     $Coorde=$co1.$co2;
     $clientes->IdZona=$request->get('IdZona');
     $clientes->IdRouter=$request->get('IdRouter');
     $clientes->IdPlanInt=$request->get('IdPlanInt');
     $clientes->Nombre=$request->get('Nombre');
     $clientes->ApellidoP=$request->get('ApellidoP');
     $clientes->ApellidoM=$request->get('ApellidoM');
     $clientes->Email=$request->get('Email');
     $clientes->Direccion=$request->get('Direccion');
     $clientes->Telefono=$request->get('Telefono');
     $clientes->Ip=$request->get('Ip');
     $clientes->MacCp=$request->get('MacCp');
     $clientes->Coordenada=$Coorde;
     $clientes->Estatus=$request->get('Estatus');


     $nombreC1=$clientes->NombreConec;
     $NombreC2=$request->get('NombreConec');

     $planest1=DB::table('planes')->where('idPlanes','=',$clientes->IdPlanInt)->select('Velocidad','Subida','Descripcion');

     $Velocidad1=preg_replace("/[^0-9]/", "", $planest1->select('Velocidad')->get());
     $Subida1=preg_replace("/[^0-9]/", "", $planest1->select('Subida')->get());
     $maxlimit1=$Velocidad1.'M'.'/'.$Subida1.'M';

     $inforouter1=DB::table('router')->where('idRouter','=',$clientes->IdRouter)->select('IP','UsuarioRB','PasswordRB');

     $DireccionIP1= $inforouter1->select('IP')->value('IP');
     $UsuarioRB11= $inforouter1->select('UsuarioRB')->value('UsuarioRB');
     $Password1= $inforouter1->select('PasswordRB')->value('PasswordRB');

     if( $clientes->Ip !="" ){
          $APIM->debug = false;
          if ($APIM->connect($DireccionIP1, $UsuarioRB11, $Password1)) {
             $APIM->write("/queue/simple/getall",false);
             $APIM->write('?name='.$nombreC1,true);
             $READ = $APIM->read(false);
             $ARRAY = $APIM->parseResponse($READ);
              if(count($ARRAY)>0){ // si el nombre de usuario "ya existe" lo edito
                  $APIM->write("/queue/simple/set",false);
                  $APIM->write("=.id=".$ARRAY[0]['.id'],false);
                  $APIM->write('=name='.$NombreC2,true);
                  $APIM->write('=max-limit='.$maxlimit1,true);   //   2M/2M   [TX/RX]
                  $READ = $APIM->read(false);
                  $ARRAY = $APIM->parseResponse($READ);
                  $clientes->NombreConec=$request->get('NombreConec');
                  $clientes->update();
                  Flash::success("Se actualizo el cliente ". $clientes->Nombre ." Exitosamente");
              }
              $APIM->disconnect();
            }
        }

     return Redirect::to('sistema/clientes');
  }

  public function mantener($id){
    $clientes=Clientes::findOrFail($id);

    return $clientes->Estatus;
  }

  public function cambio($id){

    $APIM= new ApiRoutersController;
    $clientes=Clientes::findOrFail($id);
    $clientes1=DB::table('clientes')->where('idClientes','=',$id);

    $IpC=$clientes1->select('Ip')->value('Ip');

    $Nombre1= $clientes1->select('Nombre')->value('Nombre');
    $ApellidoPP= $clientes1->select('ApellidoP')->value('ApellidoP');
    $ApellidoMM= $clientes1->select('ApellidoM')->value('ApellidoM');
    $NombreCon= $clientes1->select('NombreConec')->value('NombreConec');
    $IpR=$clientes1->select('IdRouter')->value('IdRouter');

    //Extraer datos del router
    $routers=DB::table('router')->where('idRouter','=',$IpR);
    $IpRou=$routers->select('IP')->value('IP');
    $UsuRou=$routers->select('UsuarioRB')->value('UsuarioRB');
    $PasRou=$routers->select('PasswordRB')->value('PasswordRB');

    $NombreM=$NombreCon;
    $nombreC='Moroso';

    if($clientes->Estatus=='Activo'){
           $APIM->debug = false;
           if ($APIM->connect($IpRou,$UsuRou,$PasRou)){
               $clientes->Estatus='Inactivo';
               $APIM->write("/ip/firewall/address-list/getall",false);
               $APIM->write('?address='.$IpC,false);
               $APIM->write('?list='.$nombreC,true);
               $READ = $APIM->read(false);
               $ARRAY = $APIM->parseResponse($READ); // busco si ya existe
                if(count($ARRAY)>0){
                    Flash::warning("Ya existe " . $nombreC." con la direccion: ".$IpC);
                }else{ // si no existe lo creo
                    $APIM->write("/ip/firewall/address-list/add",false);
                    $APIM->write('=address='.$IpC,false);   // IP
                    $APIM->write('=list='.$nombreC,false);       // lista
                    $APIM->write('=comment='.$NombreM,true);  // comentario
                    $READ = $APIM->read(false);
                    $ARRAY = $APIM->parseResponse($READ);
                    Flash::success("Se agrego la direccion " . $nombreC ." a la lista: ".$IpC);
                }
                $APIM->disconnect();
            }
    }
    else{
            if ($APIM->connect($IpRou,$UsuRou,$PasRou)){
                $clientes->Estatus='Activo';
               $APIM->write("/ip/firewall/address-list/getall",false);
               $APIM->write('?address='.$IpC,false);
               $APIM->write('?list='.$nombreC,true);
               $READ = $APIM->read(false);
               $ARRAY = $APIM->parseResponse($READ); // busco si ya existe
                if(count($ARRAY)>0){
                    $ID = $ARRAY[0]['.id'];
                    $APIM->write('/ip/firewall/address-list/remove', false);
                    $APIM->write('=.id='.$ID, true);
                    $READ = $APIM->read(false);
                }else{ // si no existe lo creo
                  Flash::warning('La IP "'.$IpC.'" No existe en el address-list "' . $nombreC .'" del firewall L3, no se hará nada!');
                }
                $APIM->disconnect();
              }
    }
    $clientes->update();
    return Redirect::to('sistema/clientes');
  }


  public function destroy($id){
    $clientes=DB::table('clientes')->where('idClientes','=',$id);
    $APIM= new ApiRoutersController;
    //Datos del cliente
    $Nombre1= $clientes->select('Nombre')->value('Nombre');
    $ApellidoPP= $clientes->select('ApellidoP')->value('ApellidoP');
    $ApellidoMM= $clientes->select('ApellidoM')->value('ApellidoM');
    $NombreCon= $clientes->select('NombreConec')->value('NombreConec');
    $IpR=$clientes->select('IdRouter')->value('IdRouter');
    //Extraer datos del router
    $routers=DB::table('router')->where('idRouter','=',$IpR);
    $IpRou=$routers->select('IP')->value('IP');
    $UsuRou=$routers->select('UsuarioRB')->value('UsuarioRB');
    $PasRou=$routers->select('PasswordRB')->value('PasswordRB');

    $nombreC=$NombreCon;

    if( $clientes->select('Ip')->get() !="" ){
      $APIM->debug = false;
      if ($APIM->connect($IpRou,$UsuRou,$PasRou)) {
         $APIM->write("/queue/simple/getall",false);
         $APIM->write('?name='.$nombreC,true);
         $READ = $APIM->read(false);
         $ARRAY = $APIM->parseResponse($READ);

           if(count($ARRAY)>0){ // si el nombre de usuario "ya existe" lo edito
              $APIM->write("/queue/simple/remove",false);
              $APIM->write("=.id=".$ARRAY[0]['.id'],true);
              $READ = $APIM->read(false);
              $ARRAY = $APIM->parseResponse($READ);

              Flash::success("El usuario se a eliminado");
          }else{
            Flash::warning("Usuario no encontrado en mikrotik");
          }
          $APIM->disconnect();
      }
      Clientes::destroy($id);
      return Redirect::to('sistema/clientes');
    }
  } //

}

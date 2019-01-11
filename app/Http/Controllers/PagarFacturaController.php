<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;
use sistemaTurbo\PagoFac;
use sistemaTurbo\SaldoF;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\PagoFacFormRequest;
use sistemaTurbo\http\requests\SaldoFFormRequest;
use Laracasts\Flash\Flash;
use DB;
class PagarFacturaController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');


  }
  public function index(Request $request)
  {

  }
    public function create()
  {

  }
    public function store(PagoFacFormRequest $request)
  {

  }
    public function show($id)
  {
    // return view("sistema.promesa.show",["promesas"=>Promesa::findOrFail($id)]);
  }

    public function edit($id)
  {
      $pago=PagoFac::findOrFail($id);
      $clientes=DB::table('clientes')->get();
      $formas=DB::table('formapago')->get();
    return view("sistema.factura.pagar",["pago"=>$pago,"clientes"=>$clientes,"formapagos"=>$formas]);
  }




  public function update(PagoFacFormRequest $request,$id)
  {
    $APIM= new ApiRoutersController;
    $pago=PagoFac::findOrFail($id);

    $resultado =preg_replace("/[^0-9]/", "", $pago->Total);
    $dato2= $request->get('Total');
    $resultado2 =preg_replace("/[^0-9]/", "", $dato2);
    $resta=$resultado2 - $resultado;

    $fack=DB::table('factura')
    ->where('idFactura','=',$id)
    ->select('idCliente')
    ->get();

    $cliente1 =preg_replace("/[^0-9]/", "", $fack);

    $clientes1=DB::table('clientes')->where('idClientes','=',$cliente1);

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

    $NombreM=$ApellidoPP.' '.$ApellidoMM.' '.$Nombre1.' '.$NombreCon;
    $nombreC='Moroso';

    if ($APIM->connect($IpRou,$UsuRou,$PasRou)) {
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

    if($resta > 0){
      $pago->Estado='Pagada';
      $pago->promesa=2;

      Flash::success('El monto es mayor de lo que a puesto');

          $updates = DB::table('clientes')
      	   ->where('idClientes', '=', $cliente1)
      	    ->update([
      		      'Estatus'=> 'Activo',
                'SaldoF' => $resta
      	       ]);
    }else{
      if($resta == 0){
        $pago->Estado='Pagada';
        $pago->promesa=2;
        $updates2 = DB::table('clientes')
         ->where('idClientes', '=', $cliente1)
          ->update([
              'Estatus'=> 'Activo'
             ]);
        Flash::success('Se realizo pago correctamente');
      }
      else {
        Flash::success('El monto que puso es menor del pago');
      }
    }


    // $clientes= DB::table('clientes')->where('idClientes','=',$cliente1)->increment('SaldoF', $resta);
    $pago->update();
    return Redirect::to('sistema/factura');
  }

  public function destroy($id)
  {
  // Promesa::destroy($id);
  // return Redirect::to('sistema/Promesa');
  }


}

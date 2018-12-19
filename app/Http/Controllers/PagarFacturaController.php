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

    if($resta > 0){
      $pago->Estado='Pagada';
      $pago->promesa=2;

      Flash::success('El monto es mayor de lo que a puesto');

          $updates = DB::table('clientes')
      	   ->where('idClientes', '=', $cliente1)
      	    ->update([
      		      'SaldoF' => $resta
      	       ]);
    }else{
      if($resta == 0){
        $pago->Estado='Pagada';
        $pago->promesa=2;
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

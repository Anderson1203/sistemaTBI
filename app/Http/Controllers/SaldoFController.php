<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;
use sistemaTurbo\SaldoF;
use Illuminate\Support\Facades\SaldoFRedirect;
use sistemaTurbo\http\requests\PagoFacFormRequest;
use DB;

class SaldoFController extends Controller
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
      $saldo=SaldoF::findOrFail($id);
      $clientes=DB::table('clientes')->get();
      $zonas=DB::table('zona')->get();
      $formas=DB::table('formapago')->get();
    return view("sistema.factura.pagar",["saldo"=>$saldo,"clientes"=>$clientes,"zonas"=>$zonas,"formapagos"=>$formas]);
  }


  public function update(SaldoFormRequest $request,$id)
  {
    $saldo=SaldoF::findOrFail($id);
    $saldo->SaldoF=$request->get('SaldoF');
    $saldo->update();
    return Redirect::to('sistema/factura');
  }

  public function destroy($id)
  {
  // Promesa::destroy($id);
  // return Redirect::to('sistema/Promesa');
  }
}

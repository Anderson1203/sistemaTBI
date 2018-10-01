<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;
//use sistemaTurbo\Http\Request;
use sistemaTurbo\Factura;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\FacturaFormRequest;
use DB;
class FacturaController extends Controller
{
    public function __construct()
    {


    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$facturas=DB::table('factura as f')
            ->join('clientes as c','f.IdCliente','=','c.idClientes')
            ->join('zona as z','f.IdZona','=','z.idZona')
            ->join('formapago as formas','f.FormaP','=','formas.idRegistroPago')
            ->select('f.idFactura','c.Nombre as cliente','z.Nombre as zona','formas.Nombre as nombre','f.FechaPago','f.FechaEmision','f.FechaVenci','f.Estado','f.Tipo','f.Total')
            ->where('f.tipo','like','%'.$query.'%')
            ->orderBy('f.idFactura','desc')
            ->paginate(7);
    		return view('sistema.factura.index',["facturas"=>$facturas,"searchText"=>$query]);

    	}
    }

    public function byclient($id)
   {
    $id_zonaC=DB::table('clientes')
    ->where('idClientes','=',$id)
    ->select('IdZona')->get();

     $resultado =preg_replace("/[^0-9]/", "", $id_zonaC);

     $id_z=DB::table('zona')
    ->where('idZona','=',$resultado)
    ->select('IdZona','Nombre')->get();
    return $id_z;
   }

   public function createCliente($id)
  {

        $clientes=DB::table('clientes')
        ->where('idClientes','=',$id)
        ->get();
        $nomZon=DB::table('clientes')
        ->where('idClientes','=',$id)
        ->select('IdZona')
        ->get();

        $plan=DB::table('clientes')
        ->where('idClientes','=',$id)
        ->select('IdPlanInt')
        ->get();

         $resplan =preg_replace("/[^0-9]/", "", $plan);
         $resultado1 =preg_replace("/[^0-9]/", "", $nomZon);
         
        $zonas=DB::table('zona')
        ->where('idZona','=',$resultado1)
        ->get();
        $planes=DB::table('planes')
        ->where('idPlanes','=',$resplan)
        ->get();

        $formas=DB::table('formapago')->get();
        return view('sistema.factura.create',["clientes"=>$clientes,"zonas"=>$zonas,"formas"=>$formas,"planes"=>$planes]);
  }

     public function create()
    {

          $clientes=DB::table('clientes')->get();
          $zonas=DB::table('zona')->get();
          $formas=DB::table('formapago')->get();
          return view('sistema.factura.create',["clientes"=>$clientes,"zonas"=>$zonas,"formas"=>$formas]);
    }
      public function store(FacturaFormRequest $request)
    {
    	$factura=new Factura;
    	$factura->IdCliente=$request->get('IdCliente');
    	$factura->idZona=$request->get('idZona');
    	$factura->FormaP=$request->get('FormaP');
    	$factura->FechaEmision=$request->get('FechaEmision');
    	$factura->FechaPago=$request->get('FechaPago');
    	$factura->FechaVenci=$request->get('FechaVenci');
    	$factura->Estado=$request->get('Estado');
    	$factura->Tipo=$request->get('Tipo');
    	$factura->Total=$request->get('Total');
    	$factura->save();
    	return Redirect::to('sistema/factura');
    }
      public function show($id)
    {
    	return view("sistema.factura.show",["factura"=>Factura::findOrFail($id)]);
    }
      public function edit($id)
    {
        $factura=Factura::findOrFail($id);
        $clientes=DB::table('clientes')->get();
        $zonas=DB::table('zona')->get();
        $formas=DB::table('formapago')->get();
    	return view("sistema.factura.edit",["factura"=>$factura,"clientes"=>$clientes,"zonas"=>$zonas,"formapagos"=>$formas]);
    }
      public function update(FacturaFormRequest $request,$id)
    {

    	$factura=Factura::findOrFail($id);
    	$factura->IdCliente=$request->get('IdCliente');
    	$factura->idZona=$request->get('idZona');
    	$factura->FormaP=$request->get('FormaP');
    	$factura->FechaEmision=$request->get('FechaEmision');
    	$factura->FechaPago=$request->get('FechaPago');
    	$factura->FechaVenci=$request->get('FechaVenci');
    	$factura->Estado=$request->get('Estado');
    	$factura->Tipo=$request->get('Tipo');
    	$factura->Total=$request->get('Total');
    	$factura->update();
    	return Redirect::to('sistema/factura');
    }
      public function destroy($id)
    {
    Factura::destroy($id);
    return Redirect::to('sistema/factura');
    }
}

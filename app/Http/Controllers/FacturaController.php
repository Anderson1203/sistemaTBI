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
            ->join('cliente as c','f.IdCliente','=','c.idCliente')
            ->join('zona as z','f.IdZona','=','z.idZona')
            ->join('formapago as formas','f.FormaP','=','formas.idRegistroPago')
            ->select('f.idFactura','c.Nombre as cliente','z.Nombre as zona','formas.Nombre','f.FechaPago','f.FechaEmision','f.FechaVenci','f.Estado','f.Tipo','f.Total')
            ->where('f.tipo','like','%'.$query.'%');
            //->ordeyBy('idFactura','desc')
    		return view('sistema.factura.index',["facturas"=>$facturas,"searchText"=>$query]);

    	}
    }
      public function create()
    {
          $clientes=DB::table(clientes)->get();
          $zonas=DB::table(zona)->get();
          $formas=DB::table(formaspago)->get();
          return view('sistema.factura.create',["clientes"=>$clientes,"zonas"=>$zonas,"formas"=>$formas]);    	
    }
      public function store(FacturaFormRequest $request)
    {
    	$factura=new Factura;
    	$factura->idCliente=$request->get('idCliente');
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
        $clientes=DB::table(clientes)->get();
        $zonas=DB::table(zona)->get();
        $formas=DB::table(formaspago)->get();
    	return view("sistema.factura.edid",["factura"=>$factura,"clientes"=>$clientes,"zonas"=>$zonas,"formaspago"=>$formas]);
    }
      public function update(FacturaFormRequest $request,$id)
    {

    	$factura=Factura::findOrFail($id);
    	$factura->idCliente=$request->get('idCliente');
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
    //$factura=Factura::findOrFail($id);
    //$factura->Estado=0;
    //$factura->update();
    //return Redirect::to('sistema/factura');
    }
}

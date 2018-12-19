<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

//use sistemaTurbo\Http\Request;
use sistemaTurbo\Pagosf;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\PagosfFormRequest;
use DB;

class PagosfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$pagosf=DB::table('factura as f')
            ->join('clientes as c','f.IdCliente','=','c.idClientes')
            ->join('formapago as formas','f.FormaP','=','formas.idRegistroPago')
            ->select('f.idFactura','c.Nombre as cliente','formas.Nombre as nombre','f.FechaPago','f.FechaEmision','f.FechaVenci','f.Estado','f.Tipo','f.Total')
            ->where('f.tipo','like','%'.$query.'%')
            ->where ('Estado','=','Pendiente')
            ->orderBy('f.idFactura','desc')
            ->paginate(7);
    		return view('sistema.pagof.index',["pagosf"=>$pagosf,"searchText"=>$query]);

    	}
    }
      public function create()
    {
          $clientes=DB::table('clientes')->get();
          $zonas=DB::table('zona')->get();
          $formas=DB::table('formapago')->get();
          return view('sistema.pagof.create',["clientes"=>$clientes,"zonas"=>$zonas,"formas"=>$formas]);
    }
      public function store(PagosfFormRequest $request)
    {
    	$pagof=new Pagosf;
    	$pagof->IdCliente=$request->get('IdCliente');
    	$pagof->idZona=$request->get('idZona');
    	$pagof->FormaP=$request->get('FormaP');
    	$pagof->FechaEmision=$request->get('FechaEmision');
    	$pagof->FechaPago=$request->get('FechaPago');
    	$pagof->FechaVenci=$request->get('FechaVenci');
    	$pagof->Estado=$request->get('Estado');
    	$pagof->Tipo=$request->get('Tipo');
    	$pagof->Total=$request->get('Total');
    	$pagof->save();
    	return Redirect::to('sistema/pagof');
    }
      public function show($id)
    {
    	return view("sistema.pagof.show",["pagosf"=>Pagosf::findOrFail($id)]);
    }
      public function edit($id)
    {
        $pagof=Pagosf::findOrFail($id);
        $clientes=DB::table('clientes')->get();
        $zonas=DB::table('zona')->get();
        $formas=DB::table('formapago')->get();
    	return view("sistema.pagof.edit",["pagof"=>$pagof,"clientes"=>$clientes,"zonas"=>$zonas,"formapagos"=>$formas]);
    }
      public function update(PagosfFormRequest$request,$id)
    {

    	$pagof=Pagosf::findOrFail($id);
    	$pagof->IdCliente=$request->get('IdCliente');
    	$pagof->idZona=$request->get('idZona');
    	$pagof->FormaP=$request->get('FormaP');
    	$pagof->FechaEmision=$request->get('FechaEmision');
    	$pagof->FechaPago=$request->get('FechaPago');
    	$pagof->FechaVenci=$request->get('FechaVenci');
    	$pagof->Estado=$request->get('Estado');
    	$pagof->Tipo=$request->get('Tipo');
    	$pagof->Total=$request->get('Total');
    	$pagof->update();
    	return Redirect::to('sistema/pagof');
    }
      public function destroy($id)
    {
    Pagosf::destroy($id);
    return Redirect::to('sistema/Pagof');
    }
}

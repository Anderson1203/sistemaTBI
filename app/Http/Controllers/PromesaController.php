<?php

namespace sistemaTurbo\Http\Controllers;

//use sistemaTurbo\Http\Request;
use sistemaTurbo\Promesa;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\PromesaFormRequest;
use DB;

use Illuminate\Http\Request;

class PromesaController extends Controller
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
    		$promesas=DB::table('factura as f')
            ->join('clientes as c','f.IdCliente','=','c.idClientes')
            ->join('formapago as formas','f.FormaP','=','formas.idRegistroPago')
            ->select('f.idFactura','c.Nombre as cliente','formas.Nombre as nombre','f.FechaPago','f.FechaEmision','f.FechaVenci','f.Estado','f.Tipo','f.Total')
            ->where('f.tipo','like','%'.$query.'%')
            ->where ('promesa','=','1')
            ->orderBy('f.idFactura','desc')
            ->paginate(7);
    		return view('sistema.promesa.index',["promesas"=>$promesas,"searchText"=>$query]);

    	}
    }
      public function create()
    {

    }
      public function store(PromesaFormRequest $request)
    {

    }
      public function show($id)
    {
    	return view("sistema.promesa.show",["promesas"=>Promesa::findOrFail($id)]);
    }
      public function edit($id)
    {
        $promesa=Promesa::findOrFail($id);
        $clientes=DB::table('clientes')->get();
        $zonas=DB::table('zona')->get();
        $formas=DB::table('formapago')->get();
    	return view("sistema.promesa.edit",["promesa"=>$promesa,"clientes"=>$clientes,"zonas"=>$zonas,"formapagos"=>$formas]);
    }
      public function update(PromesaFormRequest$request,$id)
    {

    	$promesa=Promesa::findOrFail($id);
    	$promesa->FechaVenci=$request->get('FechaVenci');
        $promesa->promesa=1;
    	$promesa->update();
    	return Redirect::to('sistema/promesa');
    }
      public function destroy($id)
    {
    Promesa::destroy($id);
    return Redirect::to('sistema/Promesa');
    }
}

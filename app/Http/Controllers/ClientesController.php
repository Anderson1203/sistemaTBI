<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\Clientes;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\ClientesFormRequest;
use DB;
class ClientesController extends Controller
{
  public function __construct(){

  }

  public function index(Request $request){

    $query=trim($request->get('searchText'));
    		$clientes=DB::table('clientes as c')
            ->join('zona as zo','c.IdZona','=','zo.idZona')
            ->join('planes as p','c.IdPlanInt','=','p.idPlanes')
            ->join('router as r','c.IdRouter','=','c.idRouter')
            ->select('c.idClientes','zo.Nombre as zonas','p.Nombre as planess','r.Nombre as routers',
                     'c.Nombre','c.ApellidoP','c.ApellidoM','c.Direccion')
            ->where('c.Nombre','like','%'.$query.'%')
            ->orderBy('c.idClientes','desc')
            ->paginate(7);
    		return view('sistema.clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
     }


  public function create(){
    $zona=DB::table('zona')->get();
    $planes=DB::table('planes')->get();
    $router=DB::table('router')->get();
     return view("sistema.clientes.create",["zona"=>$zona,"planes"=>$planes,"router"=>$router]);
  }

  public function store(ClientesFormRequest $request){
  $clientes= new Clientes;
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
  $clientes->Coordenada=$request->get('Coordenada');
  $clientes->Estatus=$request->get('Estatus');
  $clientes->save();
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
     $clientes=Clientes::findOrFail($id);
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
     $clientes->Coordenada=$request->get('Coordenada');
     $clientes->Estatus=$request->get('Estatus');
     $clientes->update();
     return Redirect::to('sistema/clientes');
  }

  public function destroy($id){
    Clientes::destroy($id);
    return Redirect::to('sistema/clientes');
  }

}

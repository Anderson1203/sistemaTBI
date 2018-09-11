<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;
use sistemaTurbo\routes\web;
use sistemaTurbo\Clientes;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\Http\Requests\ClientesFormRequest;
use DB;
class ClientesController extends Controller
{
  public function __construct(){

  }

  public function index(Request $request){
     if($request){
       $query=trim($request->get('searchText'));
       $clientes=DB::table('clientes as a')
       ->join('zona as c','a.IdZona','=','c.idZona')
       ->join('planes as p','a.idPlanInt','=','p.idPlanInt')
       ->join('router as r','a.idRouter','=','r.idRouter')
       ->select('a.idCliente','a.Nombre','a.ApellidoP','a.ApellidoM','a.Email',
                'a.Direccion','a.Telefono','p.Nombre as planes','r.Nombre as router')
       ->where('a.Nombre','LIKE','%'.$query.'%');
       return view('sistema.clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
     }
  }

  public function create(){
    $zona=DB::table('zona')->get();
    $planes=DB::table('planes')->get();
    $router=DB::table('router')->get();
     return view("sistema.zona.create",["zona"=>$zona,"planes"=>$planes,"router"=>$router]);
  }

  public function store(ClientesFormRequest $request){
     $clientes = new Clientes;
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
     return veiw ("sistema.clientes.edit",["clientes"=>$clientes,"zona"=>$zona,
                  "planes"=>$planes,"router"=>$router]);
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
     return Redirect::to('sistema/zona');
  }

  public function destroy($id){
    $clientes=Clientes::findOrFail($id);
  }
}

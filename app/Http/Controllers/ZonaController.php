<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\Http\Requests;
use sistemaTurbo\Zona;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\Http\Requests\ZonaFormRequest;
use DB;

class ZonaController extends Controller
{
   public function __construct(){

   }

   public function index(Request $request){
      if($request){
        $query=trim($request->get('searchText'));
        $zona=DB::table('zona')->where('Nombre','LIKE','%'.$query.'%');
        return view('sistema.zona.index',["zona"=>$zona,"searchText"=>$query]);
      }
   }

   public function create(){
      return view("sistema.zona.create");
   }

   public function store(ZonaFormRequest $request){
      $zona = new Zona;
      $zona->Nombre=$request->get('Nombre');
      $zona->Descripcion=$request->get('Descripcion');
      $zona->Tipo=$request->get('Tipo');
      $zona->Aviso=$request->get('Aviso');
      $zona->CreaFactura=$request->get('CreaFactura');
      $zona->Hora1=$request->get('Hora1');
      $zona->DiaPago=$request->get('DiaPago');
      $zona->Recordar=$request->get('Recordar');
      $zona->Hora2=$request->get('Hora2');
      $zona->RecorPago=$request->get('RecorPago');
      $zona->CortePago=$request->get('CortePago');
      $zona->Hora3=$request->get('Hora3');
      $zona->Suspender=$request->get('Suspender');
      $zona->Impuesto=$request->get('Impuesto');
      $zona->Moneda=$request->get('Moneda');
      $zona->save();
      return Redirect::to('sistema/zona');
   }

   public function show($id){
      return veiw ("sistema.zona.show",["zona"=>Zona::findOrFail($id)]);
   }

   public function edit($id){
      return veiw ("sistema.zona.edit",["zona"=>Zona::findOrFail($id)]);
   }

   public function update(ZonaFormRequest $request,$id){
      $zona=Zona::findOrFail($id);
      $zona->Nombre=$request->get('Nombre');
      $zona->Descripcion=$request->get('Descripcion');
      $zona->Tipo=$request->get('Tipo');
      $zona->Aviso=$request->get('Aviso');
      $zona->CreaFactura=$request->get('CreaFactura');
      $zona->Hora1=$request->get('Hora1');
      $zona->DiaPago=$request->get('DiaPago');
      $zona->Recordar=$request->get('Recordar');
      $zona->Hora2=$request->get('Hora2');
      $zona->RecorPago=$request->get('RecorPago');
      $zona->CortePago=$request->get('CortePago');
      $zona->Hora3=$request->get('Hora3');
      $zona->Suspender=$request->get('Suspender');
      $zona->Impuesto=$request->get('Impuesto');
      $zona->Moneda=$request->get('Moneda');
      $zona->update();
      return Redirect::to('sistema/zona');
   }

   public function destroy($id){
    // $zona=Zona::findOrFail($id);

   }
}

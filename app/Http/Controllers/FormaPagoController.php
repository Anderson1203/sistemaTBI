<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\FormaPago;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\FormaPagoFormRequest;
use DB;

class FormaPagoController extends Controller
{
  public function __construct()
  {


  }
  public function index(Request $request)
  {
    if ($request)
    {
      $query=trim($request->get('searchText'));
      $formapago=DB::table('formapago')->where('Nombre','like','%'.$query.'%')
      ->orderBy('idRegistroPago','desc')
      ->paginate(7);
      //->orderBy('idPlanes','desc')
      return view('sistema.formapago.index',["formapago"=>$formapago,"searchText"=>$query]);

    }
  }
    public function create()
  {
        return view('sistema.formapago.create');
  }
    public function store(FormaPagoFormRequest $request)
  {
    $formapago=new FormaPago;
    $formapago->Nombre=$request->get('Nombre');
    $formapago->Descripcion=$request->get('Descripcion');
    $formapago->save();
    return Redirect::to('sistema/formapago');
  }
    public function show($id)
  {
    return view("sistema.formapago.show",["formapago"=>FormaPago::findOrFail($id)]);
  }
    public function edit($id)
  {
    return view("sistema.formapago.edit",["formapago"=>FormaPago::findOrFail($id)]);
  }
    public function update(FormaPagoFormRequest $request,$id)
  {

    $formapago= FormaPago::findOrFail($id);
    $formapago->Nombre=$request->get('Nombre');
    $formapago->Descripcion=$request->get('Descripcion');
    $formapago->update();
    return Redirect::to('sistema/formapago');
  }
  public function destroy($id)
  {
    FormaPago::destroy($id);
    return Redirect::to('sistema/formapago');
  }
}

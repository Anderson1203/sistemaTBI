<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\Registrop;
use sistemaTurbo\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\Http\Requests\RegistropFormRequests;
use DB;

class RegistropController extends Controller
{
  public function __construct(){
   $this->middleware('auth');

  }


  public function index(Request $request){
    if($request){
       $query=trim($request->get('searchText'));
       $usuario=DB::table('pagos as p')
           ->join('usuarios as u','p.IdUsu','=','u.IdUser')
           ->select('p.IdPagos','u.Nombres as Nombreu','u.ApellidoP as ApellidoPP','u.ApellidoM as ApellidoMM','p.Imagen')
           ->where('p.IdPagos','like','%'.$query.'%')
           ->orderBy('p.IdPagos','desc')
           ->paginate(10);
       return view('sistema.pagos.index',["usuario"=>$usuario,"searchText"=>$query]);
     }
  }



  public function create(){

  }

  public function store(ZonaFormRequest $request){

  }

  public function show($id){
     return veiw ("sistema.pagos.show",["usuario"=>Registrop::findOrFail($id)]);
  }

  public function edit($id){

  }

  public function update(ZonaFormRequest $request,$id){

  }

  public function destroy($id){

  }
}

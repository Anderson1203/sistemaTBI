<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\Router;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\RouterFormRequest;
use DB;

class RouterController extends Controller
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
    		$routers=DB::table('router as r')
    		->join('zona as z','r.idZona','=','z.idZona')
    		->select('r.idRouter','r.Nombre','r.IP','r.UsuarioRB','r.PuertoApi','z.Nombre as zona')
    		->where('r.Nombre','LIKE','%'.$query.'%')
    		->orderBy('r.idRouter','desc')
            ->paginate(7);
    		return view('sistema.router.index',["routers"=>$routers,"searchText"=>$query]);

    	}
    }
      public function create()	
    {
    	  $zonas=DB::table('zona')->get();
          return view('sistema.router.create',["zonas"=>$zonas]);    	
    }
      public function store(RouterFormRequest $request)
    {
    	$router=new Router;
    	$router->idZona=$request->get('idZona');
        $router->Nombre=$request->get('Nombre');
        $router->IP=$request->get('IP');
        $router->UsuarioRB=$request->get('UsuarioRB');
        $router->PasswordRB=$request->get('PasswordRB');
        $router->PuertoApi=$request->get('PuertoApi');
    	$router->PuertoW=$request->get('PuertoW');
    	$router->Interfaz=$request->get('Interfaz');
    	$router->Rangos=$request->get('Rangos');
    	$router->Coordenadas=$request->get('Coordenadas');
    	$router->save();
    	return Redirect::to('sistema/router');
    }
      public function show($id)
    {
    	return view("sistema.router.show",["router"=>Router::findOrFail($id)]);
    }
      public function edit($id)
    {
    	$router=Router::findOrFail($id);
    	$zonas=DB::table('zona')->get();
    	return view("sistema.router.edit",["router"=>$router,"zonas"=>$zonas]);
    }
    public function update(RouterFormRequest $request,$id)
     {

    	$router=Router::findOrFail($id);
    	$router->idZona=$request->get('idZona');
    	$router->Nombre=$request->get('Nombre');
    	$router->IP=$request->get('IP');
    	$router->UsuarioRB=$request->get('UsuarioRB');
    	$router->PasswordRB=$request->get('PasswordRB');
    	$router->PuertoApi=$request->get('PuertoApi');
    	$router->PuertoW=$request->get('PuertoW');
    	$router->Interfaz=$request->get('Interfaz');
    	$router->Rangos=$request->get('Rangos');
    	$router->Coordenadas=$request->get('Coordenadas');
    	$router->update();
    	return Redirect::to('sistema/router');
    }
      public function destroy($id)
    {
    Router::destroy($id);
    return Redirect::to('sistema/router');
    }
}

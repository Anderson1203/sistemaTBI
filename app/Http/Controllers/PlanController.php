<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

//use sistemaTurbo\Http\Request;
use sistemaTurbo\Plan;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\PlanFormRequest;
use DB;

class PlanController extends Controller
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
    		$planes=DB::table('planes')->where('Nombre','LIKE','%'.$query.'%')
            ->orderBy('idPlanes','desc')
    		->paginate(7);
    		return view('sistema.plan.index',["planes"=>$planes,"searchText"=>$query]);

    	}

    }
      public function create()
    {
          return view('sistema.plan.create');    	
    }
      public function store(PlanFormRequest $request)
    {
    	$plan=new Plan;
    	$plan->Nombre=$request->get('Nombre');
    	$plan->Precio=$request->get('Precio');
    	$plan->Velocidad=$request->get('Velocidad');
    	$plan->Subida=$request->get('Subida');
    	$plan->Descripcion=$request->get('Descripcion');
    	$plan->save();
    	return Redirect::to('sistema/plan');
    }
      public function show($id)
    {
    	return view("sistema.plan.show",["plan"=>Plan::findOrFail($id)]);
    }
      public function edit($id)
    {
    	return view("sistema.plan.edit",["plan"=>Plan::findOrFail($id)]);
    }
      public function update(PlanFormRequest $request,$id)
    {

    	$plan=Plan::findOrFail($id);
        $plan->Nombre=$request->get('Nombre');
    	$plan->Precio=$request->get('Precio');
    	$plan->Velocidad=$request->get('Velocidad');
    	$plan->Subida=$request->get('Subida');
    	$plan->Descripcion=$request->get('Descripcion');
    	$plan->update();
    	return Redirect::to('sistema/plan');
    }
      public function destroy($id)
    {
    Plan::destroy($id);
    return Redirect::to('sistema/plan');
    }
}

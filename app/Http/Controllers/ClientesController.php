<?php

namespace sistemaTurbo\Http\Controllers;

use Illuminate\Http\Request;

use sistemaTurbo\Clientes;
use Illuminate\Support\Facades\Redirect;
use sistemaTurbo\http\requests\ClientesFormRequest;
use DB;
use Laracasts\Flash\Flash;
use Mail;
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
            ->select('c.idClientes','zo.Nombre as zonas','p.Nombre as planess','r.Nombre as routers','c.Nombre','c.ApellidoP','c.ApellidoM','c.Direccion','c.Estatus')
            ->where('c.Nombre','like','%'.$query.'%')
            ->orderBy('c.idClientes','desc')
            ->paginate(10);
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
  $APIM= new ApiRoutersController;

  $co1=$request->get('Coord');
  $co2=$request->get('Coord1');
  $Coorde=$co1.$co2;
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
  $clientes->Coordenada=$Coorde;
  $clientes->Estatus=$request->get('Estatus');
  $clientes->SaldoF=0;
  if($request->get('Referencia') == null){
    $clientes->Referencia='';
  }else{
    $clientes->Referencia=$request->get('Referencia');
  }


  $planest=DB::table('planes')->where('idPlanes','=',$clientes->IdPlanInt)->select('Velocidad','Subida','Descripcion');

   $comment='';

   $nombreC= $clientes->ApellidoP .' '.$clientes->ApellidoM.' '.$clientes->Nombre.' '.$clientes->Referencia;
  $Velocidad=preg_replace("/[^0-9]/", "", $planest->select('Velocidad')->get());

  $Subida=preg_replace("/[^0-9]/", "", $planest->select('Subida')->get());
  $maxlimit=$Velocidad.'M'.'/'.$Subida.'M';


  if( $clientes->Ip !="" ){
    $APIM->debug = false;
    if ($APIM->connect('192.168.100.1','admin','')) {

            $APIM->write("/queue/simple/add",false);
            $APIM->write('=target='.$clientes->Ip,false);   // IP
            $APIM->write('=name='.$nombreC,false);       // nombre
            $APIM->write('=max-limit='.$maxlimit,false);   //   2M/2M   [TX/RX]
            $APIM->write('=comment='.$comment,true);         // comentario
            $READ = $APIM->read(false);
            $ARRAY = $APIM->parseResponse($READ);

        $APIM->disconnect();
    }
}

  $clientes->save();

  Flash::success("Se registro el cliente ". $clientes->Nombre ." Exitosamente");
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
     $co1=$request->get('Coord');
     $co2=$request->get('Coord1');
     $Coorde=$co1.$co2;
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
     $clientes->Coordenada=$Coorde;
     $clientes->Estatus=$request->get('Estatus');
     $clientes->update();
     return Redirect::to('sistema/clientes');
  }

  public function mantener($id){
    $clientes=Clientes::findOrFail($id);

    return $clientes->Estatus;
  }

  public function cambio($id){
    $clientes=Clientes::findOrFail($id);
    if($clientes->Estatus=='Activo'){
      $clientes->Estatus='Inactivo';
    }
    else{
      $clientes->Estatus='Activo';
    }
    $clientes->update();
    return Redirect::to('sistema/clientes');
  }


  public function destroy($id){
    $clientes=DB::table('clientes')->where('idClientes','=',$id);
    $APIM= new ApiRoutersController;


    $ap=preg_replace("([^A-Za-z0-9])", "", $clientes->select('ApellidoP')->get());
    $sepAp=strtolower(preg_replace("/([A-Z])/", " $1", $ap));

    $parte = explode(" ",$sepAp);
    $ApeP= $parte[3];

    $am=preg_replace("([^A-Za-z0-9])", "", $clientes->select('ApellidoM')->get());
    $sepAm=strtolower(preg_replace("/([A-Z])/", " $1", $am));
    $parte2 = explode(" ",$sepAm);
    $ApeM= $parte2[3];

    $Nom=preg_replace("([^A-Za-z0-9])", "", $clientes->select('Nombre')->get());
    $sepNom=strtolower(preg_replace("/([A-Z])/", " $1", $Nom));
    $parte3 = explode(" ",$sepNom);
    $Nom1= $parte3[2];

    $Ref=preg_replace("([^A-Za-z0-9])", "", $clientes->select('Referencia')->get());
    if($Ref=='Referencia'){
      $Ref2='';
    }
    else{
      $sepRef=strtolower(preg_replace("/([A-Z])/", " $1", $Ref));
      $parte5 = explode(" ",$sepRef);
      $Ref2=$parte5[2];;
    }
    




    $tres=ucfirst($Nom1);
    $uno=ucfirst($ApeP);
    $dos=ucfirst($ApeM);
    $cinco=ucfirst($Ref2);

    if(count($parte3)==4){
      $Nom2= $parte3[3];

      $cuatro=ucfirst($Nom2);

      $nombreC= $uno .' '.$dos.' '.$tres.' '.$cuatro.' '.$cinco;

    }else {

      $nombreC= $uno .' '.$dos.' '.$tres.' '.$cinco;
    }

    if( $clientes->select('Ip')->get() !="" ){
      $APIM->debug = false;
      if ($APIM->connect('192.168.100.1','admin','')) {
         $APIM->write("/queue/simple/getall",false);
         $APIM->write('?name='.$nombreC,true);
         $READ = $APIM->read(false);
         $ARRAY = $APIM->parseResponse($READ);

           if(count($ARRAY)>0){ // si el nombre de usuario "ya existe" lo edito
              $APIM->write("/queue/simple/remove",false);
              $APIM->write("=.id=".$ARRAY[0]['.id'],true);
              $READ = $APIM->read(false);
              $ARRAY = $APIM->parseResponse($READ);
              Clientes::destroy($id);
              // echo "Error: El nombre no puede estar duplicado, el queue fue editado.";
          }
          $APIM->disconnect();
      }

    return Redirect::to('sistema/clientes');
  }
}

}

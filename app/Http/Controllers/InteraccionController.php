<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use App\Models\Perro;
use Illuminate\Http\Request;

class InteraccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $interaccion= interaccion::all();
        return Interaccion::orderBy('created_at', 'asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'perro_interesado_id'=>'required',
            'perro_candidato_id'=>'required',
            'preferencia' =>'required'
        ];
        $mensaje=[
            "perro_interesado_id.required"=>'Debe ingresar un Perro interesado',
            "perro_candidato_id.required"=>'Debe ingresar un Perro candidato',
            "preferencia.required"=> 'Se debe indicar una preferencia'
        ];
        $this->validate($request,$campos,$mensaje);
        $perro_id = Perro::all()->pluck('id')->toArray();
        $interesado = $request->input('perro_interesado_id');
        $candidato = $request->input('perro_candidato_id');
        $preferencia = $request->input('preferencia');
        $patron = "/^(?:R|A)$/";

        if(!(in_array($interesado, $perro_id))){
            return response()->json('El perro ingresado no existe', status:400);
        }

        if(!(in_array($candidato, $perro_id))){
            return response()->json('El perro ingresado no existe', status:400);
        }

        if($candidato == $interesado){
            return response()->json('El perro candidato e interesado no pueden coincidir', status:400);
        }

        if(preg_match($patron,$preferencia)!=1){
            return response()->json('La preferencia solo puede ser Apruebo o Rechazo', status:400);
        }

        $interesados = Interaccion::where('perro_interesado_id',$interesado)->get();
        
        foreach ($interesados as $LI) {
            if(($LI->perro_candidato_id) == $candidato && ($LI->perro_interesado_id) == $interesado){
                return response()->json('Ya existe esa interacción', status:400);  
            }
        }

        
        $interaccion = new Interaccion;
        $interaccion->perro_interesado_id = $interesado;
        $interaccion->perro_candidato_id = $candidato;
        $interaccion->preferencia = $preferencia;
        $interaccion->save();
        return response()->json($interaccion, status:201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interaccion  $interaccion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Interaccion::where('peero_interesado_id','=',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interaccion  $interaccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Interaccion $interaccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interaccion  $interaccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'perro_candidato_id'=>'required',
            'preferencia' =>'required'
        ];
        $mensaje=[
            "perro_candidato_id.required"=>'Debe ingresar un Perro candidato',
            "preferencia.required"=> 'Se debe indicar una preferencia'
        ];
        $this->validate($request,$campos,$mensaje);
        $perro_id = Perro::all()->pluck('id')->toArray();
        $candidato = $request->input('perro_candidato_id');
        $preferencia = $request->input('preferencia');
        $patron = "/^(?:R|A)$/";

        if(!(in_array($id, $perro_id))){
            return response()->json('El perro ingresado no existe', status:400);
        }

        if(!(in_array($candidato, $perro_id))){
            return response()->json('El perro ingresado no existe', status:400);
        }

        if($candidato == $id){
            return response()->json('El perro candidato e interesado no pueden coincidir', status:400);
        }

        if(preg_match($patron,$preferencia)!=1){
            return response()->json('La preferencia solo puede ser Apruebo o Rechazo', status:400);
        }

        $interesados = Interaccion::where('perro_interesado_id',$id)->get();
        
        foreach ($interesados as $LI) {
            if(($LI->perro_candidato_id) == $candidato && ($LI->perro_interesado_id) == $id){
                return response()->json('Ya existe esa interacción', status:400);  
            }
        }

        
        $interaccion = Interaccion::findorFail($id);
        $interaccion->perro_interesado_id = $id;
        $interaccion->perro_candidato_id = $candidato;
        $interaccion->preferencia = $preferencia;
        $interaccion->save();
        return response()->json($interaccion, status:201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interaccion  $interaccion
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        $interaccion = Interaccion::findorFail($id);
        if($interaccion->delete()){
            return response()->json('Interaccion retirada exitosamente', status:201);
        }
    }
}

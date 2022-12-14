<?php

namespace App\Http\Controllers;

use App\Models\Perro;
use Illuminate\Http\Request;

class PerroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $perro= perro::all();

        return Perro::orderBy('created_at', 'asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('perro.create');
    }
    public function candidato(){
        $db = Perro::whereHas('interaccions', function ($query){
            $query->where('preferencia', 'A');
        })->get();
        return $db;
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
            'perro_nombre'=>'required|string|max:30',
            'perro_descripcion'=>'required|string|max:150',
            'perro_foto' =>'required|image|max:2048'
        ];
        $mensaje=[
            "perro_nombre.required"=>'El nombre del perro es requerido',
            "perro_nombre.string"=>'El nombre debe poseer numeros o letras',
            "perro_nombre.max"=>'El nombre del perro no puede contener mas de 30 caracteres',
            "perro_descripcion.required"=>'La descripción del perro es requerida',
            "perro_descripcion.string"=>'La descripción debe poseer numeros o letras',
            "perro_descripcion.max"=>'La descripción del perro no puede contener mas de 150 caracteres',
            "perro_foto.required"=>'La URL de la foto del perro es requerida',
            "perro_foto.max"=>'El tamaño maximo del archivo es 2 MB'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosPerro=$request->except('_token');
        if($request->hasFile('perro_foto')){
            $datosPerro['perro_foto']=$request->file('perro_foto')->store('uploads', 'public');
        }
        Perro::insert($datosPerro);
        return response()->json($datosPerro, status:201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perro  $perro
     * @return \Illuminate\Http\Response
     */
    public function show($perro_id)
    {
        return Perro::findorFail($perro_id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perro  $perro
     * @return \Illuminate\Http\Response
     */
    public function edit($perro_id)
    {
        //
        $perfil=Perro::where('id',$perro_id)->firstorFail();
        return view('perro.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perro  $perro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $perro_id)
    {
        //
        $campos=[
            'perro_nombre'=>'required|string|max:30',
            'perro_descripcion'=>'required|string|max:150',
            'perro_foto' =>'required|image|max:2048'
        ];
        $mensaje=[
            "perro_nombre.required"=>'El nombre del perro es requerido',
            "perro_nombre.string"=>'El nombre debe poseer numeros o letras',
            "perro_nombre.max"=>'El nombre del perro no puede contener mas de 30 caracteres',
            "perro_descripcion.required"=>'La descripción del perro es requerida',
            "perro_descripcion.string"=>'La descripción debe poseer numeros o letras',
            "perro_descripcion.max"=>'La descripción del perro no puede contener mas de 150 caracteres',
            "perro_foto.required"=>'La URL de la foto del perro es requerida',
            "perro_foto.max"=>'El tamaño maximo del archivo es 2 MB'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosPerro=$request->except('_token', '_method');
        Perro::where('id','=',$perro_id)->update($datosPerro);
        return response()->json($datosPerro, status:201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perro  $perro
     * @return \Illuminate\Http\Response
     */
    public function destroy($perro_id)
    {
        //
        $perro = Perro::findorFail($perro_id);
        if($perro->delete()){
            return response()->json('Perro retirado exitosamente', status:201);
        }
    }
}

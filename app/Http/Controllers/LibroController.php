<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Categoria;
use Illuminate\Http\Request;
use LengthException;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $libros = Libro::all();
        $categorias=Categoria::all();

        return view('biblioteca.index', compact('libros','categorias'));
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

        $validate = $this->Validate($request, [
            'titulo'=>'required',
            'autor'=>'required',
            'editorial'=>'required',
            'categoria_id'=>'required'
        ]);
        Libro::create($request->all());
        return redirect()->route('libro.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(libro $libro)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(libro $libro)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // dd($request);

        $validate = $this->Validate($request, [
            'titulo'=>'required',
            'autor'=>'required',
            'editorial'=>'required',
            'categoria_id'=>'required'
        ]);

        $libro = Libro::find($request->id);
        $libro->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $libro = Libro::find($request->id);
        $libro->destroy($request->all());
        return back();
    }


    public function destroyVarios(Request $request){


        $ids=trim($request->ids,',');// para eliminar la coma  al principio o final de la cadena, acepta como parámetro el caracter que queremos filtrar o eliminar: en este caso la ,
        $idsArray = explode(',',$ids);

        for($i=0;$i < count($idsArray); $i++){
            $id = $idsArray[$i];
            Libro::destroy($id);
        }
        return back();

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\proo;
use Illuminate\Http\Request;

class ProoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lista=proo::all();
        return view ('proveedores', ['lista' => $lista]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $add = new proo();
        $add->nombre_p = $request->nombre_p;
        $add->dir_p = $request->dir_p;
        $add->tel_p = $request->tel_p;
        $add->cuit_p = $request->cuit_p;
        $add->save();
        return redirect()->route('pro.index')->with('mensajeOk',$request->nombre_p.' Se cargó correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(proo $proo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(proo $proo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $proo)
    {
        $actual = proo::find($proo);
        $actual->nombre_p = $request->nombre_p;
        $actual->dir_p = $request->dir_p;
        $actual->tel_p = $request->tel_p;
        $actual->cuit_p = $request->cuit_p;
        $actual->save();
        return redirect()->route('pro.index')->with('mensajeOk','Se actualizó correctamente a '.$request->nombre_p);
        echo $actual;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proo $proo)
    {
        $del = proo::find($proo->id);
        $del->delete();
        return redirect()->route('pro.index')->with('mensajeOk','Se eliminó correctamente a '.$proo->nombre_p);
    }
}

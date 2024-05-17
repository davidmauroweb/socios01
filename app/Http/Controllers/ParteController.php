<?php

namespace App\Http\Controllers;

use App\Models\parte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(parte $parte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(parte $parte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::table('partes')->where('id',$request->part_id)->where('us_id',$request->us_id)->where('fac_id',$request->fac_id)->update(['estado' => $request->estado, 'updated_at' => now()]);
        return redirect()->route('fac.show',$request->fac_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(parte $parte)
    {
        //
    }
}

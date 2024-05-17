<?php

namespace App\Http\Controllers;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Auth;
use App\Models\{factura,parte,proo,user};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
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
        $us=Auth::user()->id;
        $pro = proo::all();
        $propias = DB::table('facturas')
            ->join('proos','proos.id','=','facturas.pro_id')
            ->join('partes','facturas.id','=','partes.fac_id')
            ->select('proos.nombre_p','facturas.id as fid','facturas.num_f','facturas.monto', DB::raw('sum(partes.parte) as total'))
            ->where('facturas.us_id','=',$us)
            ->where('partes.estado','=','0')
            ->groupBy('partes.fac_id')
            ->orderBy('facturas.id', 'desc')
            ->get();
            return view ('facturas', ['propias' => $propias, 'pro'=>$pro]);
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
        $us=Auth::user()->id;
        $add = new factura();
        $add->num_f = $request->num_f;
        $add->monto = $request->monto;
        $add->pro_id = $request->pro_id;
        $add->us_id = $us;
        $add->save();
        $ultFac = DB::table('facturas')->select('facturas.id')->orderByDesc('facturas.id')->first();
        $totalSoc = DB::table('users')->select(DB::raw('sum(users.porcion) as tot'))->first();
        $parte = $request->monto / $totalSoc->tot;
        $soc = user::all();
        foreach($soc as $i){
            if($i->id == $us){
                $est=1;
            }else{
                $est=0;
            }
            $par = new parte();
            $par->parte = $i->porcion*$parte;
            $par->estado = $est;
            $par->us_id = $i->id;
            $par->fac_id = $ultFac->id;
            $par->save();
        };
        return redirect()->route('fac.index')->with('mensajeOk',' La factura cargó correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(factura $f)
    {
        $fac=factura::find($f->id);
        $us=user::find($f->us_id);
        $pro=proo::find($f->pro_id);
        $par=DB::table('partes')->select('partes.estado','partes.parte','users.name','partes.created_at','partes.updated_at')->where('partes.fac_id','=',$f->id)->join('users','users.id','partes.us_id')->orderBy('partes.estado')->get();
        return view ('detfac', ['fac' => $fac, 'pro' => $pro, 'us' => $us, 'par' => $par]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(factura $factura)
    {
        //
    }
}

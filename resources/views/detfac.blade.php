@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="bi bi-file-ruled"></i> {{ __('Detalle y estado de la factura')}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <b><i class="bi bi-card-checklist"> Detalle</i></b>
                    <table class="table table-striped">
                        <thead>
                        <th>Cargada por</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Numero de Factura</th>
                        <th>Monto</th>
                        <th>Cancelado</th>
                        <th>%</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$us->name}}</td>
                                <td>{{ date('d/m/Y', strtotime($fac->created_at)) }}</td>
                                <td>{{$pro->nombre_p}}</td>
                                <td>{{$fac->num_f}}</td>
                                <td>{{number_format($fac->monto,2,',','.')}}</td>
                                <td>{{number_format($can->total,2,',','.')}}</td>
                                <td>{{number_format(($can->total/$fac->monto)*100,2,',','.')}}</td>
                            </tr>                        
                        </tbody>
                    </table>
                    <b><i class="bi bi-toggles2"> Estado</i></b>
                    <table class="table table-striped">
                        <thead>
                            <th>Socio</th>
                            <th>Parte</th>
                            <th>Creado</th>
                            <th>Movimiento</th>
                            <th>Estado</th>
                            <th><i class="bi bi-shuffle"></i></th>
                        </thead>
                        @foreach($par as $p)
                        @php
                            if ($p->estado == 0){
                                    $color="danger";
                                    $e=1;
                                    $t="Pendiente";
                                    $btn="success";
                                }else{
                                    $color="success";
                                    $e=0;
                                    $t="Cancelado";
                                    $btn="danger";
                                };
                        @endphp
                        <tr class="table-{{$color}}">
                            <td>{{$p->name}}</td>
                            <td>{{number_format($p->parte,2,',','.')}}</td>
                            <td>{{date('d/m/Y', strtotime($p->created_at))}}</td>
                            <td>{{date('d/m/Y', strtotime($p->updated_at))}}</td>
                            <td>{{$t}}</td>
                            <td>
                                <form action="{{route('part.update')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="part_id" value="{{$p->id}}">
                                    <input type="hidden" name="us_id" value="{{$p->us_id}}">
                                    <input type="hidden" name="fac_id" value="{{$p->fac_id}}">
                                    <input type="hidden" name="estado" value="{{$e}}">
                                    <button type="submit" class="btn btn-{{$btn}} btn-sm"
                                    @if($p->us_id == Auth::user()->id)
                                    disabled
                                    @endif
                                    ><i class="bi bi-shuffle"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

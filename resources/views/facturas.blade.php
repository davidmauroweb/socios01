@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-2 border-warning">
            <div class="card-header bg-warning"><i class="bi bi-file-ruled"></i> {{ __('Lista de partes pendientes') }}</div>
            <div class="card-body">
            <table class="table table-striped">
            <thead>
            <td><b>Fecha</b></td><td><b>Cargada</b></td><td><b>Proveedor</b></td><td><b>N.Factura</b></td><td align="right"><b>Monto</b></td>
            </thead>
            @php 
            $x=0
            @endphp
            @foreach ($pen as $p)
            <tr class="table-warning">
                <td>{{ date('d/m/Y', strtotime($p->created_at)) }}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->nombre_p}}</td>
                <td>{{$p->num_f}}</td>
                <td align="right">{{number_format($p->parte,2,',','.')}}</td>
            </tr>
            @php
            $x+=$p->parte
            @endphp
            @endforeach
            <tr class="table-info">
                <td></td><td></td><td></td><td>Total</td><td>{{number_format($x,2,',','.')}}</td>
            </tr>
            </table>
            </div>

            </div>
            <div class="card border-primary">
                <div class="card-header bg-primary text-white"><i class="bi bi-file-ruled"></i>{{ __('Lista de facturas propias') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead><th>#</th><th></th><th>Proveedor</th><th>Cargada</th><th>N.Factura</th><th>Monto</th><th>Cancelado</th><th>%</th></thead>
                        <tbody>
                        @foreach ($propias as $f)
                        <tr>
                            <td>{{$f->fid}}</td>
                            <td>
                                <a href="{{ route('fac.show',$f->fid) }}">
                                <button type="button" class="btn btn-outline-primary btn-sm"><i class="bi bi-card-checklist"></i></button></a>
                            </td>
                            <td>{{$f->nombre_p}}</td>
                            <td>{{ date('d/m/Y', strtotime($f->created_at)) }}</td>
                            <td>{{$f->num_f}}</td>
                            <td>{{number_format($f->monto,2,',','.')}}</td>
                            <td>{{number_format($f->monto - $f->total,2,',','.')}}</td>
                            <td>{{number_format(($f->monto - $f->total)*100/$f->monto,2,',','.')}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mm">Agregar</button>
                <div class="modal fade" id="mm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Agregar Factura</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('fac.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                    <div>
                                        Proveedor
                                        <select name="pro_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                        <option selected></option>
                                        @foreach ($pro as $p)
                                        <option value="{{$p->id}}">{{$p->nombre_p}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        Número
                                        <input type="text" name="num_f" class="form-control form-control-sm" value="" maxlength="20" required>
                                    </div>
                                    <div>
                                        Monto
                                        <input type="number" name="monto" class="form-control form-control-sm" value="" maxlength="20" required>
                                    </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success btn-sm">Cargar</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

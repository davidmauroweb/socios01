@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estado de la factura ')}}{{$fac->id}} </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                        <th>Cargada por</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Numero de Factura</th>
                        <th>Monto</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$us->name}}</td>
                                <td>{{ date('d/m/Y', strtotime($fac->created_at)) }}</td>
                                <td>{{$pro->nombre_p}}</td>
                                <td>{{$fac->num_f}}</td>
                                <td>{{number_format($fac->monto,2,',','.')}}</td>
                            </tr>                            
                        </tbody>
                    </table>
Estado
                    <table class="table table-striped">
                        <thead>
                            <th>Socio</th>
                            <th>Parte</th>
                            <th>Creado</th>
                            <th>Redistro</th>
                            <th>Estado</th>
                        </thead>
                        @foreach($par as $p)
                        <tr class="
                        @if ($p->estado == 0)
                                table-danger
                                @else
                                table-success
                                @endif
                        ">
                            <td>{{$p->name}}</td>
                            <td>{{number_format($p->parte,2,',','.')}}</td>
                            <td>{{date('d/m/Y', strtotime($p->created_at))}}</td>
                            <td>{{date('d/m/Y', strtotime($p->updated_at))}}</td>
                            <td>@if ($p->estado == 0)
                                Pendiente
                                @else
                                Cancelado
                                @endif
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

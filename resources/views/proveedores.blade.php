@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white"><i class="bi bi-people"></i> {{ __('Lista de Proveedores') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead><th>#</th><th></th><th>Nombre</th><th>Domicilio</th><th>Tel.</th><th>CUIT</th></thead>
                        <tbody>
                        @foreach ($lista as $p)
                            <tr>
                                <td>{{$p->id}}</td>

                                <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$p->id}}" title="Editar Proveedor"><i class="bi bi-pencil-square"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="m{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Editar {{$p->nombre_p}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <form action="{{route('pro.update', $p->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div>
                                                Nombre
                                                <input type="text" name="nombre_p" class="form-control form-control-sm" value="{{$p->nombre_p}}" maxlength="50">
                                            </div>
                                            <div>
                                                Dirección
                                                <input type="text" name="dir_p" class="form-control form-control-sm" value="{{$p->dir_p}}" maxlength="50">
                                            </div>
                                            <div>
                                                Teléfono
                                                <input type="text" name="tel_p" class="form-control form-control-sm" value="{{$p->tel_p}}" maxlength="20">
                                            </div>
                                            <div>
                                                CUIT
                                                <input type="text" name="cuit_p" class="form-control form-control-sm" value="{{$p->cuit_p}}" maxlength="13">
                                            </div>                                        
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </td>


                                <td>{{$p->nombre_p}}</td>
                                <td>{{$p->dir_p}}</td>
                                <td>{{$p->tel_p}}</td>
                                <td>{{$p->cuit_p}}</td>
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
                            <h6 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('pro.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                    <div>
                                        Nombre
                                        <input type="text" name="nombre_p" class="form-control form-control-sm" value="" placeholder="Nombre" maxlength="50" required>
                                    </div>
                                    <div>
                                        Dirección
                                        <input type="text" name="dir_p" class="form-control form-control-sm" value="" maxlength="50" required>
                                    </div>
                                    <div>
                                        Teléfono
                                        <input type="text" name="tel_p" class="form-control form-control-sm" value="" maxlength="20" required>
                                    </div>
                                    <div>
                                        CUIT
                                        <input type="text" name="cuit_p" class="form-control form-control-sm" value="" placeholder="XX-XXXXXXXX-X" maxlength="13" required>
                                    </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
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

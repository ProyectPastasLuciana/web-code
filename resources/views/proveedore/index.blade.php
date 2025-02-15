@extends('template')

@section('title','proveedores')


@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="{{asset('css/usuarios/user_index.css')}}" rel="stylesheet" />
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4 blurred">
    <h1 class="mt-4 title"><i class="fa-solid fa-users icons"></i>Proveedores</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Proveedores</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('proveedores.create') }}">
            <button type="button" class="btn btn-success">Añadir nuevo registro</button>
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla proveedores
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Documento</th>
                        <th>Tipo de persona</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $item)
                    <tr>
                        <td>{{ $item->persona->razon_social }}</td>
                        <td>{{ $item->persona->direccion }}</td>
                        <td>
                            <p class="fw-semibold mb-1">{{ $item->persona->documento->tipo_documento }}</p>
                            <p class="text-muted mb-0">{{ $item->persona->numero_documento }}</p>
                        </td>
                        <td>{{ $item->persona->tipo_persona }}</td>
                        <td>
                            @if ($item->persona->estado == 1)
                            <span class="fw-bolder rounded bg-success text-white p-1">activo</span>
                            @else
                            <span class="fw-bolder rounded bg-danger text-white p-1">eliminado</span>
                            @endif
                        </td>
                        <td><!--Botones-->
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                <form action="{{route('proveedores.edit',['proveedore'=>$item])}}" method="get">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </form>

                                @if ($item->persona->estado == 1)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}"  >Eliminar</button>
                                @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}" >Restaurar</button>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de confirmación-->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->persona->estado == 1 ? '¿Seguro que quieres eliminar el proveedor?' : '¿Seguro que quieres restaurar el proveedor?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('proveedores.destroy', ['proveedore' => $item->persona->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush

@extends('template')

@section('title', 'Productos')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="{{ asset('css/producto/producto_index.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="container-fluid px-4 blurred">
    <h1 class="mt-4 title"><i class="fa-solid fa-box icons"></i>Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>
    <div class="mb-4">
        <a href="{{ route('productos.create') }}">
            <button type="button" class="btn btn-success">Añadir nuevo Producto</button>
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabla Productos
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Presentación</th>
                    <th>Categorias</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $item)
                <tr>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->marca->Caracteristica->nombre }}</td>
                    <td>{{ $item->presentacione->Caracteristica->nombre }}</td>
                    <td>
                        @foreach ($item->categorias as $category)
                        <div class="container">
                            <div class="row">
                                <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{ $category->Caracteristica->nombre }}</span>
                            </div>
                        </div>
                        @endforeach
                    </td>
                    <td>
                        @if ($item->estado == 1)
                        <span class="fw-bolder rounded p-1 bg-success text-white">ACTIVO</span>
                        @else
                        <span class="fw-bolder rounded p-1 bg-danger text-white">ELIMINADO</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <form action="{{ route('productos.edit', ['producto' => $item]) }}" method="get">
                                <button type="submit" class="btn btn-success">Editar</button>
                            </form>

                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#verModal-{{ $item->id }}">Ver</button>

                            @if ($item->estado == 1)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">Eliminar</button>
                            @else
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">Restaurar</button>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- Modal para ver detalles -->
                <div class="modal fade" id="verModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles del Producto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label><span class="fw-bolder">Descripción:</span> {{ $item->descripcion }}</label>
                                </div>
                                <div class="row mb-3">
                                    <label><span class="fw-bolder">Fecha de Vencimiento:</span> {{ $item->fecha_vencimiento == '' ? 'No tiene' : $item->fecha_vencimiento }}</label>
                                </div>
                                <div class="row mb-3">
                                    <label class="fw-bolder">Stock:</label> {{ $item->stock }}
                                </div>
                                <div class="row mb-3">
                                    <label class="fw-bolder">Imagen:</label>
                                    <div>
                                        @if ($item->img_path != null)
                                            <img src="{{ Storage::url('productos/' . $item->img_path) }}" alt="{{ $item->nombre }}" class="img-fluid img-thumbnail border border-4 rounded">
                                        @else
                                            <img src="" alt="No hay imagen disponible">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de confirmación -->
                <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $item->estado == 1 ? '¿Seguro que quieres eliminar el producto?' : '¿Seguro que quieres restaurar el producto?' }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <form action="{{ route('productos.destroy', ['producto' => $item->id]) }}" method="post">
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

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush

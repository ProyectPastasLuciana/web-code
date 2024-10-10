@extends('template')

@section('title','')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="{{asset('css/presentacion/presentacion_index.css')}}" rel="stylesheet" />
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4 blurred">
    <h1 class="mt-4 title"><i class="fa-solid fa-box icons"></i>Presentaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Presentaciones</li>
    </ol>
    <div class="mb-4">
        <a href="{{route('presentaciones.create')}}">
            <button type="button" class="btn btn-success">Añadir nueva presentacion</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla presentaciones
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($presentaciones as $presentacione)
                        <tr>
                            <td>{{$presentacione->caracteristica->nombre}}</td>
                            <td>{{$presentacione->caracteristica->descripcion}}</td>
                            
                            <td><!--Estados-->
                                @if ($presentacione->caracteristica->estado == 1)
                                    <span class="fw-bolder rounded bg-success text-white p-2">Activo</span>
                                @else 
                                <span class="fw-bolder rounded bg-danger text-white p-2">Eliminado</span>
                                @endif
                            </td>

                            <td><!--Botones-->
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{route('presentaciones.edit',['presentacione'=> $presentacione])}}" method="get">
                                        <button type="submit" class="btn btn-primary size_btn">Editar</button>
                                    </form>
                                    @if ($presentacione ->caracteristica->estado == 1)
                                    <button type="button" class="btn btn-danger size_btn" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$presentacione->id}}" >Eliminar</button>
                                    @else
                                    <button type="button" class="btn btn-success size_btn" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$presentacione->id}}" >Restaurar</button>
                                    @endif
                                  </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal-{{$presentacione->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmacion</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{$presentacione->caracteristica->estado == 1 ? '¿Seguro seguro de eliminar esta presentacion?': '¿Seguro seguro de restaurar esta presentacion?'}} 
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <form action="{{route('presentaciones.destroy',['presentacione'=>$presentacione->id])}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                <button type="submit" class="btn btn-danger">confirmar</button>
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
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
@endpush
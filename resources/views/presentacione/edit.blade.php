@extends('template')

@section('title','')

@push('css')
<link href="{{asset('css/presentacion/presentacion_edit.css')}}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4 blurred">
    <h1 class="mt-4 title"><i class="fa-solid fa-box icons"></i> Editar presentacion</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{ route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item "><a href="{{ route('presentaciones.index')}}">Presentaciones</a></li>
        <li class="breadcrumb-item ">Editar Presentacion</li>
    </ol>

    <div class="container w-100 border border-2 p-4 mt-3">
        <form action="{{ route('presentaciones.update',['presentacione'=> $presentacione]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="nombre" class="form-label" >Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$presentacione->caracteristica->nombre)}}">
                    @error('nombre')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="descripcion" class="form-label">Descripcio</label>
                    <textarea name="descripcion" id="descripcion" row="3" class="form-control">{{old('descripcion',$presentacione->caracteristica->descripcion)}}</textarea>
                    @error('descripcion')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="btn_keep">Actualizar</button>
                    <button type="reset"  class="btn btn-danger" >Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
@endpush
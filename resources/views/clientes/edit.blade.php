@extends('template')

@section('title','Editar Cliente')

@push('css')
<link href="{{asset('css/usuarios/user_edit.css')}}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid px-4 blurred">
    <h1 class="mt-4 title"><i class="fa-solid fa-users icons"></i>Editar Cliente</h1>
    <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index')}}">Clientes</a></li>
        <li class="breadcrumb-item active">Editar Cliente</li>
    </ol>

    <div class="card">
        <form action="{{ route('clientes.update',$cliente->id) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-3">
                <!--Tipo de persona -->
                <div class="col-md-6">
                    <label for="tipo_persona" class="form-label">Tipo de cliente: <span class="fw-bold">{{strtoupper ($cliente->persona->tipo_persona)}}</span></label>
                </div>

                <!--Razon social -->
                <div class="col-12" id="box-razon-social">
                    @if ($cliente->persona->tipo_persona == 'natural')
                        <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos:</label>
                    @else
                        <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa:</label>
                    @endif

                    <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social',$cliente->persona->razon_social)}}">

                    @error('razon_social')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                   <!------Dirección---->
                   <div class="col-12">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input required type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion',$cliente->persona->direccion)}}">
                    @error('direccion')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                 <!--------------Documento------->
                 <div class="col-md-6">
                    <label for="documento_id" class="form-label">Tipo de documento:</label>
                    <select class="form-select" name="documento_id" id="documento_id">
                        @foreach ($documentos as $item)
                        @if ($cliente->persona->documento_id == $item -> id)
                            <option selected value="{{$item->id}}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}</option>
                        @else
                            <option  value="{{$item->id}}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}</option>
                        @endif
                       
                        @endforeach
                    </select>
                    @error('documento_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="numero_documento" class="form-label">Numero de documento:</label>
                    <input required type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old('numero_documento',$cliente->persona->numero_documento)}}">
                    @error('numero_documento')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>



            <div class="col-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary" id="btn_keep" >Actualizar</button>
                <button type="reset"  class="btn btn-danger" onclick="window.location='{{ route('clientes.index') }}'" >Cancelar</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')


@endpush

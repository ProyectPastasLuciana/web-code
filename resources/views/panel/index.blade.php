@extends('template')

@section('title','Panel')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="{{asset('css/panel.css')}}" rel="stylesheet" />

@endpush

@section('content')

@if (session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let message = "{{ session('success') }}";
        Swal.fire(message);

    });
</script>
@endif

<div class="container-fluid px-4 blurred">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Primary Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Warning Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-6">
            <div class="tabla-productos">
                    <table class="tabla table table-striped">
                        <thead>
                          <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Spaghetti</td>
                            <td>10.000</td>
                            <td>Deliciosos espaguetis perfectos para cualquier ocasión.</td>
                          </tr>
                          <tr>
                            <td>Cabello de Ángel</td>
                            <td>10.000</td>
                            <td>Un dulce y suave cabello de ángel ideal para postres.</td>
                          </tr>
                          <tr>
                            <td>Fetuccini</td>
                            <td>10.000</td>
                            <td>Una pasta ancha y sabrosa que complementa cualquier salsa.</td>
                          </tr>
                          <tr>
                            <td>Tallarín</td>
                            <td>10.000</td>
                            <td>Clásica pasta larga para platos tradicionales.</td>
                          </tr>
                          <tr>
                            <td>Lasaña</td>
                            <td>10.000</td>
                            <td>Capas de pasta y deliciosa salsa bechamel y boloñesa.</td>
                          </tr>
                          <tr>
                            <td>Ravioli de Carne</td>
                            <td>18.000</td>
                            <td>Ricos ravioles rellenos de carne, acompañados de salsa.</td>
                          </tr>
                          <tr>
                            <td>Ravioli de Pollo</td>
                            <td>18.000</td>
                            <td>Ravioles con un relleno jugoso de pollo y especias.</td>
                          </tr>
                          <tr>
                            <td>Ravioli de Espinaca Ricotta</td>
                            <td>18.000</td>
                            <td>Ravioles vegetarianos con espinacas y queso ricotta.</td>
                          </tr>
                        </tbody>
                      </table>
                      
                </div>
        </div>
        <div class="col-xl-6">
        <div class="producto"><!--Slider productos-->
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">

                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
                          <button type="button" data-bs-target="#demo" data-bs-slide-to="7"></button>
                        </div>
                        
                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{ asset('assets/img/Productos/spaghetti.png') }}" alt="Spaghetti" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/cabelloangel.png') }}" alt="Cabello de Angel" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/fetuccini.png') }}" alt="Fetuccini" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/tallarin.png') }}" alt="Tallarin" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/lasaña.png') }}" alt="Lasaña" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/r_carne.png') }}" alt="Ravioli-Carne" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/r_pollo.png') }}" alt="Ravioli-Pollo" class="d-block" style="width:100%">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/img/Productos/r_espinaca.png') }}" alt="Ravioli-Espinaca Ricotta" class="d-block" style="width:100%">
                          </div>
                        </div>
                        
                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                          <span class="carousel-control-next-icon"></span>
                        </button>
                      </div>
                      
                      <div class="text-cont">
                        <h3>PRODUCTOS</h3>
                        <p>Crea deliciosas preparaciones con los mejores productos que solo nosotros 
                            podemos darte para la nutrición de toda tu familia y negocio.
                        </p>
                      </div> 
                </div>
        </div>
    </div>

@endsection

@push('js')
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script-->
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
@endpush
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Clientes
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped" >
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Documento</th>
                        <th>Tipo de Persona</th>
                        <th>Estado</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($clientes as $item )
                        <tr>
                            <td>
                                {{$item -> persona -> razon_social}}
                            </td>
                            <td>
                                {{$item -> persona -> direccion}}
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$item -> persona -> documento -> tipo_documento}}</p>
                                <p class="text-muted mb-0">{{$item -> persona -> numero_documento}}</p>
                            </td>
                            <td>
                                {{$item -> persona -> tipo_persona}}
                            </td>
                            <td>
                                @if ($item -> persona -> estado == 1)
                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                @else
                                <span class="fw-bolder rounded bg-danger text-white p-1">Eliminado</span>
                                @endif
                            </td>
    
                        </tr>
    
    
                        <!-- Modal de confirmación-->
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--div class="text-center m-4">
            <a href="{{ route('clientes.generarReportePDF') }}">
                <button type="button" class="btn btn-primary text-center">Generar PDF</button>
            </a>
        </div-->
        <div class="text-center m-4">
            <button type="button" class="btn btn-primary text-center" onclick="generarPDF()">Generar PDF</button>
        </div>
    </div>
    <script>
        function generarPDF() {
            // Realiza una solicitud al método de generación del PDF
            fetch('{{ route('clientes.generarReportePDF') }}')
                .then(response => {
                    if (response.ok) {
                        return response.blob(); // Obtiene el PDF como un Blob
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(blob => {
                    // Crea un enlace temporal para descargar el PDF
                    const url = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'reporte_clientes.pdf'; // Nombre del archivo
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    window.URL.revokeObjectURL(url);
    
                    // Redirige al índice después de un pequeño retraso
                    setTimeout(() => {
                        window.location.href = '{{ route('clientes.index') }}';
                    }, 1000); // 2 segundos de espera
                })
                .catch(error => {
                    console.error('Error al generar el PDF:', error);
                    alert('Ocurrió un error al generar el PDF.');
                });
        }
    </script>
</body>
</html>
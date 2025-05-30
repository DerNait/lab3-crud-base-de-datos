@extends('layouts.app')

@section('title', 'Películas')

@section('content')
<div class="container mt-4">
    {{-- Encabezado con título y botón para crear nueva película --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Películas</h1>
        <a href="{{ route('peliculas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Nueva película
        </a>
    </div>

    {{-- Tabla responsive para listar películas --}}
    <div class="table-responsive">
        <table id="peliculas-table" class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                {{-- Cabecera de columnas --}}
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Género</th>
                    <th>Clasificación</th>
                    <th>Duración</th>
                    <th>Estreno</th>
                    <th>Directores</th>
                    <th>Actores</th>
                    <th>Premios</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Filas generadas dinámicamente con datos de la vista VPelicula --}}
                @foreach ($peliculas as $p)
                    <tr>
                        {{-- Datos principales --}}
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->titulo }}</td>
                        <td>{{ $p->genero }}</td>
                        <td>{{ $p->clasificacion }}</td>
                        <td>{{ $p->duracion }} min</td>
                        <td>{{ \Carbon\Carbon::parse($p->fecha_estreno)->format('Y-m-d') }}</td>
                        {{-- Relaciones consolidadas en la vista --}}
                        <td>{{ $p->directores ?? '—' }}</td>
                        <td>{{ $p->actores ?? '—' }}</td>
                        <td>{{ $p->premios ?? '—' }}</td>
                        {{-- Acciones CRUD: Ver, Editar, Eliminar --}}
                        <td class="text-center">
                            <div class="d-flex">
                                {{-- Ver detalle --}}
                                <a href="{{ route('peliculas.show', $p->id) }}" class="btn btn-sm btn-success mx-1" title="Ver">
                                    <i class="fa fa-eye"></i>
                                </a>
                                {{-- Editar película --}}
                                <a href="{{ route('peliculas.edit', $p->id) }}" class="btn btn-sm btn-warning mx-1" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                {{-- Eliminar con confirmación --}}
                                <form action="{{ route('peliculas.destroy', $p->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar película?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mx-1" title="Eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

{{-- Encolado de estilos necesarios --}}
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

{{-- Encolado de scripts: jQuery, Bootstrap y DataTables --}}
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inicialización de DataTables con español y configuraciones básicas
            $('#peliculas-table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                columnDefs: [
                    { targets: [0], visible: false }, // Oculta la columna ID si no es necesaria
                    { orderable: false, targets: -1 } // Deshabilita ordenación en acciones
                ]
            });
        });
    </script>
@endpush
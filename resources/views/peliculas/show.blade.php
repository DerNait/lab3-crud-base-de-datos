@extends('layouts.app')

@section('title', 'Detalle de Película')

@section('content')
<div class="container mt-4">
    {{-- Título de la película --}}
    <h1 class="h3 mb-4">{{ $pelicula->titulo }}</h1>

    <div class="row">
        <div class="col-md-8">
            {{-- Detalles principales usando <dl> --}}
            <dl class="row">
                <dt class="col-sm-3">Sinopsis</dt>
                <dd class="col-sm-9">{{ $pelicula->sinopsis }}</dd>

                <dt class="col-sm-3">Fecha de estreno</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($pelicula->fecha_estreno)->format('Y-m-d') }}</dd>

                <dt class="col-sm-3">Duración</dt>
                <dd class="col-sm-9">{{ $pelicula->duracion }} minutos</dd>

                <dt class="col-sm-3">Presupuesto</dt>
                <dd class="col-sm-9">USD {{ number_format($pelicula->presupuesto, 0, ',', '.') }}</dd>

                <dt class="col-sm-3">Género</dt>
                <dd class="col-sm-9">{{ $pelicula->genero }}</dd>

                <dt class="col-sm-3">Clasificación</dt>
                <dd class="col-sm-9">{{ $pelicula->clasificacion }}</dd>
            </dl>
        </div>

        <div class="col-md-4">
            {{-- Botones de acción: editar y eliminar --}}
            <div class="mb-3">
                <a href="{{ route('peliculas.edit', $pelicula->id) }}" class="btn btn-warning me-2">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <form action="{{ route('peliculas.destroy', $pelicula->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar película?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Sección de personas con sus roles --}}
    <h4 class="mt-4">Personas</h4>
    @if($pelicula->personas->isEmpty())
        <p>—</p>
    @else
        <ul class="list-group mb-4">
            @foreach($pelicula->personas as $persona)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $persona->nombre }}
                    <span class="badge bg-secondary">{{ $persona->pivot->rol }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Sección de premios con año --}}
    <h4>Premios</h4>
    @if($pelicula->premios->isEmpty())
        <p>—</p>
    @else
        <ul class="list-group">
            @foreach($pelicula->premios as $premio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $premio->nombre }}
                    <span class="badge bg-secondary">{{ $premio->pivot->año }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Botón volver al listado --}}
    <a href="{{ route('peliculas.index') }}" class="btn btn-secondary mt-4">Volver al listado</a>
</div>
@endsection

{{-- Estilos adicionales si el layout no los incluye --}}
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

{{-- Scripts adicionales (FontAwesome) --}}
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
@endpush
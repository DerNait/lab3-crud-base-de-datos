@extends('layouts.app')

@section('title', 'Crear Película')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4">Crear nueva película</h1>

    {{-- Formulario de creación de película --}}
    <form action="{{ route('peliculas.store') }}" method="POST">
        @csrf {{-- Protección CSRF --}}

        {{-- Campos principales: título y sinopsis --}}
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                value="{{ old('titulo') }}"
                maxlength="100"
                required
            >
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sinopsis" class="form-label">Sinopsis</label>
            <textarea
                name="sinopsis"
                id="sinopsis"
                rows="4"
                class="form-control @error('sinopsis') is-invalid @enderror"
            >{{ old('sinopsis') }}</textarea>
            @error('sinopsis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campos secundarios: fecha, duración y presupuesto --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="fecha_estreno" class="form-label">Fecha de estreno</label>
                <input
                    type="date"
                    name="fecha_estreno"
                    id="fecha_estreno"
                    class="form-control @error('fecha_estreno') is-invalid @enderror"
                    value="{{ old('fecha_estreno') }}"
                    required
                >
                @error('fecha_estreno')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="duracion" class="form-label">Duración (min)</label>
                <input
                    type="number"
                    name="duracion"
                    id="duracion"
                    min="1"
                    class="form-control @error('duracion') is-invalid @enderror"
                    value="{{ old('duracion') }}"
                    required
                >
                @error('duracion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="presupuesto" class="form-label">Presupuesto (USD)</label>
                <input
                    type="number"
                    name="presupuesto"
                    id="presupuesto"
                    min="0"
                    class="form-control @error('presupuesto') is-invalid @enderror"
                    value="{{ old('presupuesto') }}"
                    required
                >
                @error('presupuesto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Selección de género y clasificación --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="genero" class="form-label">Género</label>
                <select
                    name="genero"
                    id="genero"
                    class="form-select @error('genero') is-invalid @enderror"
                    required
                >
                    <option value="">— Selecciona —</option>
                    <option value="Accion" {{ old('genero')=='Accion'?'selected':'' }}>Acción</option>
                    <option value="Comedia" {{ old('genero')=='Comedia'?'selected':'' }}>Comedia</option>
                    <option value="Drama" {{ old('genero')=='Drama'?'selected':'' }}>Drama</option>
                    <option value="Terror" {{ old('genero')=='Terror'?'selected':'' }}>Terror</option>
                    <option value="Ciencia Ficcion" {{ old('genero')=='Ciencia Ficcion'?'selected':'' }}>Ciencia Ficción</option>
                    <option value="Romance" {{ old('genero')=='Romance'?'selected':'' }}>Romance</option>
                    <option value="Documental" {{ old('genero')=='Documental'?'selected':'' }}>Documental</option>
                    <option value="Animacion" {{ old('genero')=='Animacion'?'selected':'' }}>Animación</option>
                    <option value="Fantasia" {{ old('genero')=='Fantasia'?'selected':'' }}>Fantasía</option>
                </select>
                @error('genero')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="clasificacion" class="form-label">Clasificación</label>
                <select
                    name="clasificacion"
                    id="clasificacion"
                    class="form-select @error('clasificacion') is-invalid @enderror"
                    required
                >
                    <option value="">— Selecciona —</option>
                    <option value="G" {{ old('clasificacion')=='G'?'selected':'' }}>G</option>
                    <option value="PG" {{ old('clasificacion')=='PG'?'selected':'' }}>PG</option>
                    <option value="PG-13" {{ old('clasificacion')=='PG-13'?'selected':'' }}>PG-13</option>
                    <option value="R" {{ old('clasificacion')=='R'?'selected':'' }}>R</option>
                    <option value="NC-17" {{ old('clasificacion')=='NC-17'?'selected':'' }}>NC-17</option>
                </select>
                @error('clasificacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Selección de personas con rol --}}
        <fieldset class="mb-4">
            <legend class="col-form-label">Personas</legend>
            <div class="row">
                @foreach($personas as $persona)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="personas[]"
                                value="{{ $persona->id }}"
                                id="persona_{{ $persona->id }}"
                                {{ in_array($persona->id, old('personas', [])) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="persona_{{ $persona->id }}">
                                {{ $persona->nombre }}
                            </label>
                        </div>
                        <select name="roles[{{ $persona->id }}]" class="form-select form-select-sm mt-1">
                            <option value="Director"  {{ old("roles.{$persona->id}")=='Director'  ? 'selected' : '' }}>Director</option>
                            <option value="Actor"     {{ old("roles.{$persona->id}")=='Actor'     ? 'selected' : '' }}>Actor</option>
                            <option value="Productor" {{ old("roles.{$persona->id}")=='Productor' ? 'selected' : '' }}>Productor</option>
                            <option value="Guionista" {{ old("roles.{$persona->id}")=='Guionista' ? 'selected' : '' }}>Guionista</option>
                        </select>
                    </div>
                @endforeach
            </div>
        </fieldset>

        {{-- Selección de premios con año --}}
        <fieldset class="mb-4">
            <legend class="col-form-label">Premios</legend>
            <div class="row">
                @foreach($premios as $premio)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="premios[]"
                                value="{{ $premio->id }}"
                                id="premio_{{ $premio->id }}"
                                {{ in_array($premio->id, old('premios', [])) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="premio_{{ $premio->id }}">
                                {{ $premio->nombre }}
                            </label>
                        </div>
                        <input
                            type="number"
                            name="años[]"
                            min="1888"
                            max="{{ now()->year }}"
                            class="form-control form-control-sm mt-1"
                            value="{{ old('años')[$loop->index] ?? now()->year }}"
                        >
                    </div>
                @endforeach
            </div>
        </fieldset>

        {{-- Botones de acción --}}
        <button type="submit" class="btn btn-success">Guardar película</button>
        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection
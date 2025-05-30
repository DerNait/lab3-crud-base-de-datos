@extends('layouts.app')

@section('title', 'Editar Película')

@section('content')
<div class="container mt-4">
    {{-- Título de la sección --}}
    <h1 class="h3 mb-4">Editar película</h1>

    {{-- Formulario de edición: método PUT hacia peliculas.update --}}
    <form action="{{ route('peliculas.update', $pelicula->id) }}" method="POST">
        @csrf {{-- Token CSRF --}}
        @method('PUT') {{-- Spoof HTTP PUT --}}

        {{-- Campo: Título --}}
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                value="{{ old('titulo', $pelicula->titulo) }}"
                maxlength="100"
                required
            >
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo: Sinopsis --}}
        <div class="mb-3">
            <label for="sinopsis" class="form-label">Sinopsis</label>
            <textarea
                name="sinopsis"
                id="sinopsis"
                rows="4"
                class="form-control @error('sinopsis') is-invalid @enderror"
            >{{ old('sinopsis', $pelicula->sinopsis) }}</textarea>
            @error('sinopsis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Grupo de campos: fecha de estreno, duración y presupuesto --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                {{-- Fecha de estreno --}}
                <label for="fecha_estreno" class="form-label">Fecha de estreno</label>
                <input
                    type="date"
                    name="fecha_estreno"
                    id="fecha_estreno"
                    class="form-control @error('fecha_estreno') is-invalid @enderror"
                    value="{{ old('fecha_estreno', $pelicula->fecha_estreno) }}"
                    required
                >
                @error('fecha_estreno')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                {{-- Duración en minutos --}}
                <label for="duracion" class="form-label">Duración (min)</label>
                <input
                    type="number"
                    name="duracion"
                    id="duracion"
                    min="1"
                    class="form-control @error('duracion') is-invalid @enderror"
                    value="{{ old('duracion', $pelicula->duracion) }}"
                    required
                >
                @error('duracion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                {{-- Presupuesto en USD --}}
                <label for="presupuesto" class="form-label">Presupuesto (USD)</label>
                <input
                    type="number"
                    name="presupuesto"
                    id="presupuesto"
                    min="0"
                    class="form-control @error('presupuesto') is-invalid @enderror"
                    value="{{ old('presupuesto', $pelicula->presupuesto) }}"
                    required
                >
                @error('presupuesto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Grupo de campos: género y clasificación --}}
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
                    @foreach(['Accion','Comedia','Drama','Terror','Ciencia Ficcion','Romance','Documental','Animacion','Fantasia'] as $g)
                        <option value="{{ $g }}" {{ old('genero', $pelicula->genero)==$g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
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
                    @foreach(['G','PG','PG-13','R','NC-17'] as $c)
                        <option value="{{ $c }}" {{ old('clasificacion', $pelicula->clasificacion)==$c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                @error('clasificacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @php
            // Listas de selección con datos viejos o actuales
            $selectedPersonas = old('personas', $pelicula->personas->pluck('id')->toArray());
            $personaRoles    = old('roles')
                ? old('roles')
                : $pelicula->personas->pluck('pivot.rol', 'id')->toArray();
        @endphp

        {{-- Selección de Personas con rol asociado --}}
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
                                {{ in_array($persona->id, $selectedPersonas) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="persona_{{ $persona->id }}">
                                {{ $persona->nombre }}
                            </label>
                        </div>
                        {{-- Selector de rol por persona_id --}}
                        <select name="roles[{{ $persona->id }}]" class="form-select form-select-sm mt-1">
                            @foreach(['Director','Actor','Productor','Guionista'] as $r)
                                <option value="{{ $r }}"
                                    {{ (old("roles.{$persona->id}", $personaRoles[$persona->id] ?? '') == $r) ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </fieldset>

        @php
            // Listas de premios y años viejos o actuales
            $selectedPremios = old('premios', $pelicula->premios->pluck('id')->toArray());
            $premioAnios    = old('años')
                ? old('años')
                : $pelicula->premios->pluck('pivot.año', 'id')->toArray();
        @endphp
        <fieldset class="mb-4">
            <legend class="col-form-label">Premios</legend>
            <div class="row">
                @foreach($premios as $premio)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="premios[]" value="{{ $premio->id }}"
                                   id="premio_{{ $premio->id }}"
                                   {{ in_array($premio->id, $selectedPremios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="premio_{{ $premio->id }}">
                                {{ $premio->nombre }}
                            </label>
                        </div>
                        {{-- Campo año del premio --}}
                        <input type="number" name="años[]" min="1888" max="{{ now()->year }}"
                               class="form-control form-control-sm mt-1"
                               value="{{ $premioAnios[$premio->id] ?? now()->year }}">
                    </div>
                @endforeach
            </div>
        </fieldset>

        {{-- Botones: actualizar o cancelar --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection
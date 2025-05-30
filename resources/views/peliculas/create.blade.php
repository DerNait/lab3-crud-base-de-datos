@extends('layouts.app')

@section('title', 'Crear Película')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4">Crear nueva película</h1>

    {{-- Formulario de creación de película --}}
    <form id="pelicula-form" action="{{ route('peliculas.store') }}" method="POST">
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
            @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="sinopsis" class="form-label">Sinopsis</label>
            <textarea
                name="sinopsis"
                id="sinopsis"
                rows="4"
                class="form-control @error('sinopsis') is-invalid @enderror"
            >{{ old('sinopsis') }}</textarea>
            @error('sinopsis')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                @error('fecha_estreno')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                @error('duracion')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                @error('presupuesto')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                    @foreach(['Accion','Comedia','Drama','Terror','Ciencia Ficcion','Romance','Documental','Animacion','Fantasia'] as $g)
                        <option value="{{ $g }}" {{ old('genero')==$g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
                @error('genero')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        <option value="{{ $c }}" {{ old('clasificacion')==$c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                @error('clasificacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Tabla de selección de personas con DataTables --}}
        <h4 class="mt-4">Personas</h4>
        <div class="table-responsive">
            <table id="personas-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $persona)
                        <tr>
                            <td>
                                <input
                                    type="checkbox"
                                    name="personas[]"
                                    value="{{ $persona->id }}"
                                    {{ in_array($persona->id, old('personas', [])) ? 'checked' : '' }}
                                >
                            </td>
                            <td>{{ $persona->nombre }}</td>
                            <td>
                                <select name="roles[{{ $persona->id }}]" class="form-select form-select-sm">
                                    @foreach(['Director','Actor','Productor','Guionista'] as $r)
                                        <option value="{{ $r }}" {{ old("roles.{$persona->id}")==$r ? 'selected' : '' }}>{{ $r }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tabla de selección de premios con DataTables --}}
        <h4 class="mt-4">Premios</h4>
        <div class="table-responsive">
            <table id="premios-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Premio</th>
                        <th>Año</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($premios as $premio)
                        <tr>
                            <td>
                                <input
                                    type="checkbox"
                                    name="premios[]"
                                    value="{{ $premio->id }}"
                                    {{ in_array($premio->id, old('premios', [])) ? 'checked' : '' }}
                                >
                            </td>
                            <td>{{ $premio->nombre }}</td>
                            <td>
                                <input
                                    type="number"
                                    name="años[{{ $premio->id }}]"
                                    min="1888"
                                    max="{{ now()->year }}"
                                    class="form-control form-control-sm"
                                    value="{{ old('años.' . $premio->id, now()->year) }}"
                                >
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Botones de acción --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Guardar película</button>
            <a href="{{ route('peliculas.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@push('styles')
    {{-- DataTables CSS y Bootstrap --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    {{-- jQuery y DataTables JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {

            const tPersonas = $('#personas-table').DataTable({
                language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
                paging:true, searching:true, info:false, lengthChange:false
            });

            const tPremios = $('#premios-table').DataTable({
                language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
                paging:true, searching:true, info:false, lengthChange:false
            });

            /* ---- recopilar TODAS las filas antes de enviar ---- */
            $('#pelicula-form').on('submit', function () {

                /* PERSONAS */
                tPersonas.rows().every(function () {
                    const $row = $(this.node());
                    const $chk = $row.find('input[type=checkbox][name="personas[]"]');
                    if (!$chk.length || !$chk.prop('checked')) return;

                    // checkbox
                    $('<input>', {type:'hidden', name:'personas[]', value:$chk.val()}).appendTo('#pelicula-form');
                    // rol
                    const rol = $row.find('select[name^="roles"]').val();
                    $('<input>', {type:'hidden', name:`roles[${$chk.val()}]`, value:rol}).appendTo('#pelicula-form');
                });

                /* PREMIOS */
                tPremios.rows().every(function () {
                    const $row = $(this.node());
                    const $chk = $row.find('input[type=checkbox][name="premios[]"]');
                    if (!$chk.length || !$chk.prop('checked')) return;

                    $('<input>', {type:'hidden', name:'premios[]', value:$chk.val()}).appendTo('#pelicula-form');
                    const anio = $row.find('input[name^="años["]').val();
                    $('<input>', {type:'hidden', name:`años[${$chk.val()}]`, value:anio}).appendTo('#pelicula-form');
                });
            });
        });
    </script>
@endpush
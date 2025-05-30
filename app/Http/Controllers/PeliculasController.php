<?php

namespace App\Http\Controllers;

use App\Models\VPelicula;      // Vista solo-lectura para el index
use App\Models\Pelicula;       // Modelo principal para CRUD
use App\Models\Persona;        // Para listar en create/edit
use App\Models\Premio;         // Para listar en create/edit
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class PeliculasController extends Controller
{
    /**
     * INDEX – muestra todas las películas usando la VIEW v_peliculas
     */
    public function index()
    {
        $peliculas = VPelicula::all();
        return view('peliculas.index', compact('peliculas'));
    }

    /**
     * CREATE – retorna el formulario con datos necesarios
     */
    public function create()
    {
        return view('peliculas.create', [
            'personas' => Persona::orderBy('nombre')->get(),
            'premios'  => Premio::orderBy('nombre')->get(),
        ]);
    }

    /**
     * STORE – valida y crea la película + relaciones
     */
    public function store(Request $request)
    {
        // Validación de campos y arrays de relaciones
        $data = $request->validate([
            'titulo'        => ['required','string','max:100','unique:peliculas,titulo'],
            'sinopsis'      => ['nullable','string'],
            'fecha_estreno' => ['required','date'],
            'duracion'      => ['required','integer','min:1'],
            'presupuesto'   => ['required','integer','min:0'],
            'genero'        => ['required','in:Accion,Comedia,Drama,Terror,Ciencia Ficcion,Romance,Documental,Animacion,Fantasia'],
            'clasificacion' => ['required','in:G,PG,PG-13,R,NC-17'],

            'personas'      => ['array'],
            'personas.*'    => ['integer','exists:personas,id'],
            'roles'         => ['array'],
            'roles.*'       => ['in:Director,Actor,Productor,Guionista'],

            'premios'       => ['array'],
            'premios.*'     => ['integer','exists:premios,id'],
            'años'          => ['array'],
            'años.*'        => ['integer','between:1888,' . date('Y')],
        ]);

        DB::transaction(function () use ($data) {
            // 1) Crear pelicula
            $pelicula = Pelicula::create($data);

            // 2) Sincronizar personas (rol por persona_id)
            if (!empty($data['personas'])) {
                $sync = [];
                foreach ($data['personas'] as $personaId) {
                    $rol = $data['roles'][$personaId] ?? 'Actor';
                    $sync[$personaId] = ['rol' => $rol];
                }
                $pelicula->personas()->sync($sync);
            }

            // 3) Sincronizar premios (año por premio_id)
            if (!empty($data['premios'])) {
                $sync = [];
                foreach ($data['premios'] as $premioId) {
                    $año = $data['años'][$premioId] ?? date('Y');
                    $sync[$premioId] = ['año' => $año];
                }
                $pelicula->premios()->sync($sync);
            }
        });

        return redirect()->route('peliculas.index')
                         ->with('success','Película creada');
    }

    /**
     * SHOW – muestra detalle de una película, con personas y premios
     */
    public function show(Pelicula $pelicula)
    {
        $pelicula->load('personas','premios');
        return view('peliculas.show', compact('pelicula'));
    }

    /**
     * EDIT – retorna formulario de edición con datos actuales
     */
    public function edit(Pelicula $pelicula)
    {
        $pelicula->load('personas','premios');
        return view('peliculas.edit', [
            'pelicula' => $pelicula,
            'personas' => Persona::orderBy('nombre')->get(),
            'premios'  => Premio::orderBy('nombre')->get(),
        ]);
    }

    /**
     * UPDATE – valida y actualiza película + relaciones
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        // Validación similar a store(), ignorando el mismo título
        $data = $request->validate([
            'titulo'        => ['required','string','max:100', Rule::unique('peliculas','titulo')->ignore($pelicula->id)],
            'sinopsis'      => ['nullable','string'],
            'fecha_estreno' => ['required','date'],
            'duracion'      => ['required','integer','min:1'],
            'presupuesto'   => ['required','integer','min:0'],
            'genero'        => ['required','in:Accion,Comedia,Drama,Terror,Ciencia Ficcion,Romance,Documental,Animacion,Fantasia'],
            'clasificacion' => ['required','in:G,PG,PG-13,R,NC-17'],

            'personas'      => ['array'],
            'personas.*'    => ['integer','exists:personas,id'],
            'roles'         => ['array'],
            'roles.*'       => ['in:Director,Actor,Productor,Guionista'],

            'premios'       => ['array'],
            'premios.*'     => ['integer','exists:premios,id'],
            'años'          => ['array'],
            'años.*'        => ['integer','between:1888,' . date('Y')],
        ]);

        DB::transaction(function () use ($data, $pelicula) {
            // 1) Actualizar campos de la tabla principal
            $pelicula->update($data);

            // 2) Sincronizar personas/roles
            if (!empty($data['personas'])) {
                $sync = [];
                foreach ($data['personas'] as $personaId) {
                    $rol = $data['roles'][$personaId] ?? 'Actor';
                    $sync[$personaId] = ['rol' => $rol];
                }
                $pelicula->personas()->sync($sync);
            }

            // 3) Sincronizar premios/año
            if (!empty($data['premios'])) {
                $syncPremios = [];
                foreach ($data['premios'] as $premioId) {
                    $año = $data['años'][$premioId] ?? date('Y');
                    $syncPremios[$premioId] = ['año' => $año];
                }
                $pelicula->premios()->sync($syncPremios);
            }
        });

        return redirect()->route('peliculas.index')
                         ->with('success','Película actualizada');
    }

    /**
     * DESTROY – elimina la película y, por cascada, sus pivotes
     */
    public function destroy(Pelicula $pelicula)
    {
        DB::transaction(fn() => $pelicula->delete());

        return redirect()->route('peliculas.index')
                         ->with('success','Película eliminada');
    }
}
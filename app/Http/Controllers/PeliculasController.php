<?php

namespace App\Http\Controllers;

use App\Models\VPelicula;
use App\Models\Pelicula;
use App\Models\Persona;
use App\Models\Premio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class PeliculasController extends Controller
{
    public function index()
    {
        $peliculas = VPelicula::all();
        return view('peliculas.index', compact('peliculas'));
    }

    public function create()
    {
        return view('peliculas.create', [
            'personas' => Persona::orderBy('nombre')->get(),
            'premios'  => Premio::orderBy('nombre')->get()
        ]);
    }

    public function store(Request $request)
    {
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
            $pelicula = Pelicula::create($data);

            if (!empty($data['personas'])) {
                $sync = [];
                foreach ($data['personas'] as $personaId) {
                    $rol = $data['roles'][$personaId] ?? 'Actor';
                    $sync[$personaId] = ['rol' => $rol];
                }
                $pelicula->personas()->sync($sync);
            }

            if (!empty($data['premios'])) {
                $sync = [];
                foreach ($data['premios'] as $i => $premioId) {
                    $sync[$premioId] = ['año' => $data['años'][$i] ?? date('Y')];
                }
                $pelicula->premios()->sync($sync);
            }
        });

        return redirect()->route('peliculas.index')
                         ->with('success','Película creada');
    }

    public function show(Pelicula $pelicula)
    {
        $pelicula->load('personas','premios');
        return view('peliculas.show', compact('pelicula'));
    }

    public function edit(Pelicula $pelicula)
    {
        $pelicula->load('personas','premios');
        return view('peliculas.edit', [
            'pelicula' => $pelicula,
            'personas' => Persona::orderBy('nombre')->get(),
            'premios'  => Premio::orderBy('nombre')->get()
        ]);
    }

    public function update(Request $request, Pelicula $pelicula)
    {
        $data = $request->validate([
            'titulo'        => ['required','string','max:100',Rule::unique('peliculas','titulo')->ignore($pelicula->id)],
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

            $pelicula->update($data);

            if (!empty($data['personas'])) {
                $sync = [];
                foreach ($data['personas'] as $personaId) {
                    $rol = $data['roles'][$personaId] ?? 'Actor';
                    $sync[$personaId] = ['rol' => $rol];
                }
                $pelicula->personas()->sync($sync);
            }

            $syncPremios = [];
            foreach ($data['premios'] ?? [] as $i => $premioId) {
                $syncPremios[$premioId] = ['año' => $data['años'][$i] ?? date('Y')];
            }
            $pelicula->premios()->sync($syncPremios);
        });

        return redirect()->route('peliculas.index')
                         ->with('success','Película actualizada');
    }

    public function destroy(Pelicula $pelicula)
    {
        DB::transaction(fn() => $pelicula->delete());

        return redirect()->route('peliculas.index')
                         ->with('success','Película eliminada');
    }
}

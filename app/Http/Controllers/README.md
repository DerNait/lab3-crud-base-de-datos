# PeliculasController – Laravel

Este controlador maneja la lógica CRUD de películas en una aplicación Laravel. Incluye relaciones con personas (como directores, actores, etc.) y premios, permitiendo una gestión completa de una base de datos de películas.

## Endpoints

### `index()`
Muestra todas las películas listadas a través de una vista llamada `peliculas.index`, utilizando el modelo `VPelicula`.

### `create()`
Retorna el formulario de creación de película (`peliculas.create`) incluyendo datos necesarios como personas y premios.

### `store(Request $request)`
Valida y guarda una nueva película, así como las relaciones:
- Personas asociadas con su rol (Director, Actor, etc.)
- Premios recibidos y año correspondiente

Todo esto se realiza dentro de una transacción para garantizar la consistencia de los datos.

### `show(Pelicula $pelicula)`
Muestra la vista `peliculas.show` de una película específica, incluyendo relaciones cargadas (personas y premios).

### `edit(Pelicula $pelicula)`
Devuelve el formulario de edición (`peliculas.edit`) con los datos actuales de la película.

### `update(Request $request, Pelicula $pelicula)`
Valida y actualiza los datos de una película existente, incluyendo relaciones con personas y premios, todo en una transacción segura.

### `destroy(Pelicula $pelicula)`
Elimina la película seleccionada de forma segura dentro de una transacción.

## Relaciones

- **Personas:** relación muchos a muchos con un campo adicional `rol` (pivot).
- **Premios:** relación muchos a muchos con un campo adicional `año` (pivot).

## Notas

- Utiliza el modelo `VPelicula` para el listado, lo cual puede ser una vista o modelo con relaciones precargadas.
- Todas las validaciones están incluidas en el `store` y `update`.
- Utiliza `DB::transaction()` para garantizar consistencia durante la creación y actualización.

---

Este controlador está listo para usarse con vistas basadas en Bootstrap, Datatables y FontAwesome.
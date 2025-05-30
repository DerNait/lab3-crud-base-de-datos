# Vistas del CRUD de Películas

Este proyecto contiene las vistas principales para la gestión de películas dentro de un sistema Laravel. Se utiliza Bootstrap 5 para el diseño visual, FontAwesome para los íconos, y DataTables para mejorar la experiencia con tablas dinámicas.

## Archivos de Vistas

### 1. `peliculas/index.blade.php`
Muestra una tabla con todas las películas utilizando la vista `v_peliculas`. Incluye acciones para ver, editar o eliminar una película. Se integra con DataTables para paginación, búsqueda y ordenamiento dinámico.

### 2. `peliculas/create.blade.php`
Formulario para crear una nueva película. Permite registrar información como título, sinopsis, fecha de estreno, duración, presupuesto, género, clasificación, personas relacionadas (con sus roles) y premios obtenidos (con su año).

### 3. `peliculas/edit.blade.php`
Formulario similar al de creación, pero con los campos precargados según los datos actuales de la película seleccionada. Permite modificar toda la información de la película y actualizar relaciones con personas y premios.

### 4. `peliculas/show.blade.php`
Vista detallada de una película. Muestra todos los campos relevantes, personas involucradas con su rol, y los premios obtenidos con el año correspondiente. Incluye botones para editar o eliminar la película.

### Estilos y Scripts
Las vistas usan los siguientes recursos CDN:
- Bootstrap 5.3.3 (estilos y scripts)
- FontAwesome 6.5.0
- DataTables 1.13.7 con estilo Bootstrap

## Consideraciones
- Las relaciones `personas` y `premios` se gestionan a través de pivot tables.
- Los formularios utilizan `@csrf` y métodos HTTP correctos (`POST`, `PUT`, `DELETE`).
- Se emplea validación en tiempo real para los campos requeridos.
- Las vistas están diseñadas para integrarse con un layout base `layouts.app`.

## Dependencias
Asegúrate de tener disponibles los siguientes en el layout principal:
- `@stack('styles')` en `<head>`
- `@stack('scripts')` antes de cerrar `</body>`

---  
Estas vistas forman parte del sistema CRUD de películas y están preparadas para integrarse fácilmente con controladores y modelos de Laravel.
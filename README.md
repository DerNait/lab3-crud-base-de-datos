# CRUD de Películas – Laravel + PostgreSQL

Este proyecto es una aplicación web construida con **Laravel** y **PostgreSQL** para gestionar un CRUD de películas, personas y premios.

---

## 🔧 Instrucciones para levantar el proyecto

1. **Clona el repositorio**:

   ```bash
   git clone https://github.com/DerNait/lab3-crud-base-de-datos.git
   cd lab3-crud-base-de-datos
   ```

2. **Copia el archivo `.env.example` como `.env`**:

   ```bash
   cp .env.example .env
   ```

3. **Levanta los contenedores con Docker**:

   ```bash
   docker compose up --build
   ```

4. **Accede al contenedor de la app**:

   ```bash
   docker exec -it lab3_app bash
   ```
5. **Instala las dependencias de Composer**:
   ```bash
   composer install
   ```

7. **Genera la APP_KEY de Laravel**:

   ```bash
   php artisan key:generate
   ```

8. **Ejecuta las migraciones de base de datos**:

   ```bash
   php artisan migrate
   ```

9. **Ejecuta los seeders (datos iniciales)**:

   ```bash
   php artisan db:seed
   ```

---

## 🌐 Acceso a la aplicación

Una vez iniciado el proyecto, visita en tu navegador:

```
http://localhost:8080/peliculas
```

> ⚠️ Si usaste otro puerto en tu archivo `.env`, reemplaza `8080` por el que corresponda.

---

## 📂 Archivos de base de datos

Los scripts SQL para estructura y datos iniciales están ubicados en:

```
/sql-scripts/schema.sql
/sql-scripts/data.sql
```

---

## 👨‍💻 Autores

- Kevin Villagrán – 23584
- Nery Molina – 23218

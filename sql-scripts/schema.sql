-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS pelicula_personas_id_seq;
DROP TYPE IF EXISTS "public"."role_type";
CREATE TYPE "public"."role_type" AS ENUM ('Director', 'Actor', 'Productor', 'Guionista');

-- Table Definition
CREATE TABLE "public"."pelicula_personas" (
    "id" int8 NOT NULL DEFAULT nextval('pelicula_personas_id_seq'::regclass),
    "pelicula_id" int8 NOT NULL,
    "persona_id" int8 NOT NULL,
    "rol" "public"."role_type" NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "pelicula_personas_pelicula_id_foreign" FOREIGN KEY ("pelicula_id") REFERENCES "public"."peliculas"("id") ON DELETE CASCADE,
    CONSTRAINT "pelicula_personas_persona_id_foreign" FOREIGN KEY ("persona_id") REFERENCES "public"."personas"("id") ON DELETE CASCADE,
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX pelicula_personas_pelicula_id_persona_id_rol_unique ON public.pelicula_personas USING btree (pelicula_id, persona_id, rol);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS pelicula_premios_id_seq;

-- Table Definition
CREATE TABLE "public"."pelicula_premios" (
    "id" int8 NOT NULL DEFAULT nextval('pelicula_premios_id_seq'::regclass),
    "pelicula_id" int8 NOT NULL,
    "premio_id" int8 NOT NULL,
    "año" int4 NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "pelicula_premios_pelicula_id_foreign" FOREIGN KEY ("pelicula_id") REFERENCES "public"."peliculas"("id") ON DELETE CASCADE,
    CONSTRAINT "pelicula_premios_premio_id_foreign" FOREIGN KEY ("premio_id") REFERENCES "public"."premios"("id") ON DELETE CASCADE,
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX "pelicula_premios_pelicula_id_premio_id_año_unique" ON public.pelicula_premios USING btree (pelicula_id, premio_id, "año");

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS peliculas_id_seq;
DROP TYPE IF EXISTS "public"."genre_type";
CREATE TYPE "public"."genre_type" AS ENUM ('Accion', 'Comedia', 'Drama', 'Terror', 'Ciencia Ficcion', 'Romance', 'Documental', 'Animacion', 'Fantasia');
DROP TYPE IF EXISTS "public"."rating_type";
CREATE TYPE "public"."rating_type" AS ENUM ('G', 'PG', 'PG-13', 'R', 'NC-17');

-- Table Definition
CREATE TABLE "public"."peliculas" (
    "id" int8 NOT NULL DEFAULT nextval('peliculas_id_seq'::regclass),
    "titulo" varchar(100) NOT NULL,
    "sinopsis" text,
    "fecha_estreno" date NOT NULL,
    "duracion" int4 NOT NULL,
    "presupuesto" int4 NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "genero" "public"."genre_type" NOT NULL,
    "clasificacion" "public"."rating_type" NOT NULL,
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX peliculas_titulo_fecha_estreno_unique ON public.peliculas USING btree (titulo, fecha_estreno);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS personas_id_seq;

-- Table Definition
CREATE TABLE "public"."personas" (
    "id" int8 NOT NULL DEFAULT nextval('personas_id_seq'::regclass),
    "nombre" varchar(200) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS premios_id_seq;

-- Table Definition
CREATE TABLE "public"."premios" (
    "id" int8 NOT NULL DEFAULT nextval('premios_id_seq'::regclass),
    "nombre" varchar(100) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX premios_nombre_unique ON public.premios USING btree (nombre);

 SELECT p.id,
    p.titulo,
    p.sinopsis,
    p.fecha_estreno,
    p.duracion,
    p.presupuesto,
    p.genero,
    p.clasificacion,
    string_agg(DISTINCT (
        CASE
            WHEN (pp.rol = 'Director'::role_type) THEN per.nombre
            ELSE NULL::character varying
        END)::text, ', '::text) AS directores,
    string_agg(DISTINCT (
        CASE
            WHEN (pp.rol = 'Actor'::role_type) THEN per.nombre
            ELSE NULL::character varying
        END)::text, ', '::text) AS actores,
    string_agg(DISTINCT ((((pr.nombre)::text || ' ('::text) || pprem."año") || ')'::text), ', '::text) AS premios
   FROM ((((peliculas p
     LEFT JOIN pelicula_personas pp ON ((pp.pelicula_id = p.id)))
     LEFT JOIN personas per ON ((per.id = pp.persona_id)))
     LEFT JOIN pelicula_premios pprem ON ((pprem.pelicula_id = p.id)))
     LEFT JOIN premios pr ON ((pr.id = pprem.premio_id)))
  GROUP BY p.id;


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelicula;

class PeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peliculas = [
            ['titulo'=>'Horizonte Mortal','sinopsis'=>'Un equipo de exploradores espaciales encuentra un misterio mortal más allá de Neptuno.','fecha_estreno'=>'2012-07-13','duracion'=>118,'presupuesto'=>68000000,'genero'=>'Ciencia Ficcion','clasificacion'=>'PG-13'],
            ['titulo'=>'Risas de Medianoche','sinopsis'=>'Un comediante fracasado planea su gran regreso en el show de medianoche.','fecha_estreno'=>'2019-11-08','duracion'=>102,'presupuesto'=>15000000,'genero'=>'Comedia','clasificacion'=>'PG'],
            ['titulo'=>'Ecos del Pasado','sinopsis'=>'Una periodista descubre secretos de su familia que alteran su destino.','fecha_estreno'=>'2020-02-14','duracion'=>128,'presupuesto'=>28000000,'genero'=>'Drama','clasificacion'=>'PG-13'],
            ['titulo'=>'Pesadilla Suburbana','sinopsis'=>'Extrañas desapariciones en un vecindario aparentemente perfecto.','fecha_estreno'=>'2016-10-31','duracion'=>96,'presupuesto'=>12000000,'genero'=>'Terror','clasificacion'=>'R'],
            ['titulo'=>'Galaxia 9','sinopsis'=>'La resistencia lucha contra un imperio galáctico que domina nueve sistemas solares.','fecha_estreno'=>'2015-05-22','duracion'=>134,'presupuesto'=>150000000,'genero'=>'Accion','clasificacion'=>'PG-13'],
            ['titulo'=>'Amor en Otoño','sinopsis'=>'Dos extraños se conocen cada otoño en el mismo parque.','fecha_estreno'=>'2011-09-30','duracion'=>110,'presupuesto'=>18000000,'genero'=>'Romance','clasificacion'=>'PG'],
            ['titulo'=>'Verdad bajo Fuego','sinopsis'=>'Un reportero investiga la corrupción en tiempos de guerra.','fecha_estreno'=>'2018-03-09','duracion'=>124,'presupuesto'=>40000000,'genero'=>'Drama','clasificacion'=>'R'],
            ['titulo'=>'Planeta Prohibido','sinopsis'=>'Exploradores aterrizan en un planeta donde los sueños se vuelven realidad.','fecha_estreno'=>'2013-08-16','duracion'=>112,'presupuesto'=>70000000,'genero'=>'Fantasia','clasificacion'=>'PG-13'],
            ['titulo'=>'Sombras del Bosque','sinopsis'=>'Un grupo de amigos acampa en un bosque embrujado.','fecha_estreno'=>'2017-10-13','duracion'=> 90,'presupuesto'=>10000000,'genero'=>'Terror','clasificacion'=>'R'],
            ['titulo'=>'Circuitos del Corazón','sinopsis'=>'Un androide desarrolla sentimientos en un mundo post‑humano.','fecha_estreno'=>'2021-06-18','duracion'=>108,'presupuesto'=>60000000,'genero'=>'Ciencia Ficcion','clasificacion'=>'PG-13'],
            ['titulo'=>'El Último Guardián','sinopsis'=>'Un héroe cansado protege la última ciudad libre.','fecha_estreno'=>'2014-12-19','duracion'=>126,'presupuesto'=>85000000,'genero'=>'Accion','clasificacion'=>'PG-13'],
            ['titulo'=>'Ciudad Sin Ley','sinopsis'=>'El crimen se apodera de una metrópolis futurista.','fecha_estreno'=>'2010-04-23','duracion'=>118,'presupuesto'=>50000000,'genero'=>'Accion','clasificacion'=>'R'],
            ['titulo'=>'Canción Eterna','sinopsis'=>'Una compositora busca la melodía que cambie al mundo.','fecha_estreno'=>'2022-12-02','duracion'=>104,'presupuesto'=>22000000,'genero'=>'Drama','clasificacion'=>'PG'],
            ['titulo'=>'Mundos Paralelos','sinopsis'=>'Dos adolescentes descubren portales entre realidades.','fecha_estreno'=>'2018-07-27','duracion'=>112,'presupuesto'=>30000000,'genero'=>'Fantasia','clasificacion'=>'PG'],
            ['titulo'=>'El Gran Documental','sinopsis'=>'Historias de humanidad unidas en un solo filme.','fecha_estreno'=>'2019-01-25','duracion'=>90,'presupuesto'=>5000000,'genero'=>'Documental','clasificacion'=>'G'],
            ['titulo'=>'Viaje Animado','sinopsis'=>'Un chico y su llama voladora recorren mundos de papel.','fecha_estreno'=>'2014-11-14','duracion'=>94,'presupuesto'=>35000000,'genero'=>'Animacion','clasificacion'=>'G'],
            ['titulo'=>'Dragones y Magia','sinopsis'=>'Reinos antiguos enfrentan dragones renacidos.','fecha_estreno'=>'2013-07-05','duracion'=>140,'presupuesto'=>120000000,'genero'=>'Fantasia','clasificacion'=>'PG-13'],
            ['titulo'=>'Frontera Letal','sinopsis'=>'Policías y contrabandistas luchan en la frontera más peligrosa.','fecha_estreno'=>'2012-02-10','duracion'=>115,'presupuesto'=>48000000,'genero'=>'Accion','clasificacion'=>'R'],
            ['titulo'=>'El Comediante','sinopsis'=>'Un actor de stand‑up intenta triunfar en la gran ciudad.','fecha_estreno'=>'2011-06-03','duracion'=>98,'presupuesto'=>12000000,'genero'=>'Comedia','clasificacion'=>'PG-13'],
            ['titulo'=>'Destino Perdido','sinopsis'=>'Una astronauta queda varada en una estación abandonada.','fecha_estreno'=>'2016-09-16','duracion'=>107,'presupuesto'=>65000000,'genero'=>'Ciencia Ficcion','clasificacion'=>'PG-13'],
            ['titulo'=>'Relatos de la Luna','sinopsis'=>'Historias cortas que ocurren bajo la misma luna llena.','fecha_estreno'=>'2015-04-10','duracion'=>101,'presupuesto'=>17000000,'genero'=>'Drama','clasificacion'=>'PG'],
            ['titulo'=>'Caos Urbano','sinopsis'=>'Manifestaciones violentas sacuden una capital latinoamericana.','fecha_estreno'=>'2023-03-24','duracion'=>119,'presupuesto'=>32000000,'genero'=>'Accion','clasificacion'=>'R'],
            ['titulo'=>'Amor Inesperado','sinopsis'=>'Un chef y una crítica gastronómica se enamoran en secreto.','fecha_estreno'=>'2017-02-10','duracion'=>113,'presupuesto'=>20000000,'genero'=>'Romance','clasificacion'=>'PG-13'],
            ['titulo'=>'Monstruos Oceánicos','sinopsis'=>'Biólogos marinos enfrentan gigantes del abismo.','fecha_estreno'=>'2021-08-20','duracion'=>110,'presupuesto'=>90000000,'genero'=>'Terror','clasificacion'=>'PG-13'],
            ['titulo'=>'Ciber Rebelión','sinopsis'=>'Hackers jóvenes combaten una dictadura digital.','fecha_estreno'=>'2019-05-17','duracion'=>105,'presupuesto'=>45000000,'genero'=>'Accion','clasificacion'=>'PG-13'],
            ['titulo'=>'Bajo la Lluvia','sinopsis'=>'Una estación de tren conecta historias de amor.','fecha_estreno'=>'2012-11-02','duracion'=>99,'presupuesto'=>10000000,'genero'=>'Romance','clasificacion'=>'PG'],
            ['titulo'=>'Plan de Escape','sinopsis'=>'Un ex‑soldado idea una fuga imposible.','fecha_estreno'=>'2020-10-30','duracion'=>116,'presupuesto'=>38000000,'genero'=>'Accion','clasificacion'=>'R'],
            ['titulo'=>'Héroes Olvidados','sinopsis'=>'Veteranos descubren una conspiración que borra su legado.','fecha_estreno'=>'2014-05-09','duracion'=>122,'presupuesto'=>55000000,'genero'=>'Drama','clasificacion'=>'PG-13'],
            ['titulo'=>'Reino Encantado','sinopsis'=>'Una princesa rebelde trae tecnología a un mundo mágico.','fecha_estreno'=>'2018-12-14','duracion'=>108,'presupuesto'=>80000000,'genero'=>'Fantasia','clasificacion'=>'PG'],
            ['titulo'=>'La Última Nota','sinopsis'=>'Un pianista ciego compone su obra final.','fecha_estreno'=>'2022-06-24','duracion'=>97,'presupuesto'=>15000000,'genero'=>'Drama','clasificacion'=>'PG']
        ];

        Pelicula::truncate();
        Pelicula::insert($peliculas);
    }
}

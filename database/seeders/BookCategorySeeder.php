<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$categoriesData = [
			[
				'data' => [
					'order' => 1,
					'name' => 'Comics y Mangas',
					'search_results_label' => 'comics y mangas',
				],
				'children' => [
					[
						'data' => [
							'order' => 1,
							'name' => 'Comics',
						],
						'children' => [
							['order' => 1, 'name' => 'Comics Clásicos'],
							['order' => 2, 'name' => 'Comics Infantiles'],
							['order' => 3, 'name' => 'Comics Independientes'],
							['order' => 4, 'name' => 'Comics Eróticos'],
							['order' => 5, 'name' => 'Comics Europeos'],
							['order' => 6, 'name' => 'Comics Americanos'],
							['order' => 7, 'name' => 'Marvel/DC y Superhéroes'],
						],
					],
					[
						'data' => [
							'order' => 2,
							'name' => 'Mangas',
						],
						'children' => [
							['order' => 1, 'name' => 'Kodomo (Infantil)'],
							['order' => 2, 'name' => 'Shojo (Juvenil Femenino)'],
							['order' => 3, 'name' => 'Shonen (Juvenil Masculino)'],
							['order' => 4, 'name' => 'Josei (Joven Adulto Femenino)'],
							['order' => 5, 'name' => 'Seinen (Joven Adulto Masculino)'],
							['order' => 6, 'name' => 'Terror'],
							['order' => 7, 'name' => 'Series y Sagas'],
						],
					],
					[
						'data' => [
							'order' => 3,
							'name' => 'Novelas Gráficas',
						],
						'children' => [
							['order' => 1, 'name' => 'Mis Novelas Gráficas'],
							['order' => 2, 'name' => 'Clásicos de la Literatura'],
						],
					],
					[
						'data' => [
							'order' => 4,
							'name' => 'Humor Gráfico y Más',
						],
						'children' => [
							['order' => 1, 'name' => 'Humor Gráfico'],
							['order' => 2, 'name' => 'Libros de Ilustración'],
							['order' => 3, 'name' => 'Dibujo de Comic'],
							['order' => 4, 'name' => 'Dibujo/Guión'],
							['order' => 5, 'name' => 'Dibujo de Manga'],
						],
					],
				],
			],
			[
				'data' => [
					'order' => 2,
					'name' => 'Libros Infantiles',
				],
				'children' => [
					[
						'data' => [
							'order' => 1,
							'name' => 'De 0 - 2 años',
						],
						'children' => [
							['order' => 1, 'name' => 'Primeros Cuentos'],
							['order' => 2, 'name' => 'Mis Personajes Favoritos'],
							['order' => 3, 'name' => 'Libros de Tela'],
							['order' => 4, 'name' => 'Libros con Texturas'],
							['order' => 5, 'name' => 'Libros con Solapas'],
						],
					],
					[
						'data' => [
							'order' => 2,
							'name' => 'De 2 - 4 años',
						],
						'children' => [
							['order' => 1, 'name' => 'Álbumes Ilustrados de 2 a 4'],
							['order' => 2, 'name' => 'Cuentos Clásicos de 2 a 4'],
							['order' => 3, 'name' => 'Cuentos Acartonados'],
							['order' => 4, 'name' => 'Prelectura y Escritura'],
							['order' => 5, 'name' => 'Primeros Conocimientos'],
							['order' => 6, 'name' => 'Mis Personajes Favoritos'],
							['order' => 7, 'name' => 'Libros sobre los Valores'],
						],
					],
					[
						'data' => [
							'order' => 3,
							'name' => 'De 5 - 8 años',
						],
						'children' => [
							['order' => 1, 'name' => 'Álbumes Ilustrados de 5 a 8'],
							['order' => 2, 'name' => 'Cuentos Clásicos de 5 a 8'],
							['order' => 3, 'name' => 'Literatura de 5 a 8'],
							['order' => 4, 'name' => 'Mitología Infantil de 5 a 8'],
							['order' => 5, 'name' => 'Libros para Colorear'],
							['order' => 6, 'name' => 'Manualidades'],
							['order' => 7, 'name' => 'Primeros Idiomas'],
							['order' => 8, 'name' => 'Libros de Personajes'],
						],
					],
					[
						'data' => [
							'order' => 4,
							'name' => 'De 9 - 12 años',
						],
						'children' => [
							['order' => 1, 'name' => 'Literatura de 9 a 12'],
							['order' => 2, 'name' => 'Ciencia y Naturaleza'],
							['order' => 3, 'name' => 'Mitología Infantil de 9 a 12'],
							['order' => 4, 'name' => 'Cocina y Manualidades'],
							['order' => 5, 'name' => 'Cultura y Sociales'],
							['order' => 6, 'name' => 'Series Infantiles'],
						],
					],
					[
						'data' => [
							'order' => 5,
							'name' => 'Destacados',
						],
						'children' => [
							['order' => 1, 'name' => 'Mundo Harry Potter'],
							['order' => 2, 'name' => 'Novedades'],
							['order' => 3, 'name' => 'Juegos Educativos'],
							['order' => 4, 'name' => 'Juegos Clásicos'],
							['order' => 5, 'name' => 'Juegos de Cartas infantiles'],
							['order' => 6, 'name' => 'Puzzles'],
						],
					],
				],
			],
			[
				'data' => [
					'order' => 3,
					'name' => 'Libros Juveniles',
				],
				'children' => [
					[
						'data' => [
							'order' => 1,
							'name' => 'Jóvenes Lectores',
						],
						'children' => [
							['order' => 1, 'name' => 'Más de 13 anos'],
							['order' => 2, 'name' => 'Más de 15 años'],
						],
					],
					[
						'data' => [
							'order' => 2,
							'name' => 'Literatura Juvenil',
						],
						'children' => [
							['order' => 1, 'name' => 'Romance'],
							['order' => 2, 'name' => 'Terror y Suspenso'],
							['order' => 3, 'name' => 'Ciencia Ficción'],
							['order' => 4, 'name' => 'Clásicos'],
							['order' => 5, 'name' => 'Wattpad'],
							['order' => 6, 'name' => 'Libros Juveniles en Inglés'],
						],
					],
					[
						'data' => [
							'order' => 3,
							'name' => 'Fantasía Juvenil',
						],
						'children' => [
							['order' => 1, 'name' => 'Libros Fantasía Juvenil'],
							['order' => 2, 'name' => 'Sagas Juveniles'],
						],
					],
					[
						'data' => [
							'order' => 4,
							'name' => 'Destacados',
						],
						'children' => [
							['order' => 1, 'name' => 'Novedades'],
							['order' => 2, 'name' => 'Juegos de Cartas'],
							['order' => 3, 'name' => 'Juegos de Mesa'],
							['order' => 4, 'name' => 'Figuras y Regalos'],
							['order' => 5, 'name' => 'Merchandising'],
						],
					],
				],
			],
			[
				'data' => [
					'order' => 4,
					'name' => 'Ficción',
					'menu_title' => 'Libros de Ficción',
				],
				'children' => [
					[
						'data' => [
							'order' => 1,
							'name' => 'Narrativa',
						],
						'children' => [
							['order' => 1, 'name' => 'Literatura Clásica'],
							['order' => 2, 'name' => 'Literatura Universal'],
							['order' => 3, 'name' => 'Literatura Hispanoaméricana'],
							['order' => 4, 'name' => 'Literatura Peruana'],
							['order' => 5, 'name' => 'Narrativa de Viajes'],
							['order' => 6, 'name' => 'Literatura en otros idiomas'],
							['order' => 7, 'name' => 'Cuentos'],
						],
					],
					[
						'data' => [
							'order' => 2,
							'name' => 'Novelas',
						],
						'children' => [
							['order' => 1, 'name' => 'Novela Romántica'],
							['order' => 2, 'name' => 'Novela Histórica'],
							['order' => 3, 'name' => 'Novela de Terror'],
							['order' => 4, 'name' => 'Novela Negra'],
							['order' => 5, 'name' => 'Novela Erótica'],
							['order' => 6, 'name' => 'Novela de Ciencia Ficción'],
							['order' => 7, 'name' => 'Fantasía'],
						],
					],
					[
						'data' => [
							'order' => 3,
							'name' => 'Lírica y Drama',
						],
						'children' => [
							['order' => 1, 'name' => 'Poesía'],
							['order' => 2, 'name' => 'Teatro Mundial'],
							['order' => 3, 'name' => 'Teatro Hispanoaméricano'],
							['order' => 4, 'name' => 'Teatro Infantil'],
						],
					],
				],
			],
			[
				'data' => [
					'order' => 5,
					'name' => 'No Ficción',
					'menu_title' => 'Libros de No Ficción',
				],
				'children' => [
					[
						'data' => [
							'order' => 1,
							'name' => 'Historia Universal',
						],
						'children' => [
							['order' => 1, 'name' => 'Historia Antigua y Medieval'],
							['order' => 2, 'name' => 'Historia Mundial'],
							['order' => 3, 'name' => 'Historia por Países'],
						],
					],
					[
						'data' => [
							'order' => 2,
							'name' => 'Historia del Perú',
						],
						'children' => [
							['order' => 1, 'name' => 'Historia Peruana'],
							['order' => 2, 'name' => 'Mitos y Leyendas del Perú'],
						],
					],
					[
						'data' => [
							'order' => 3,
							'name' => 'Arte',
						],
						'children' => [
							['order' => 1, 'name' => 'Arquitectura'],
							['order' => 2, 'name' => 'Cine'],
							['order' => 3, 'name' => 'Diseño y Moda'],
							['order' => 4, 'name' => 'Fotografía'],
							['order' => 5, 'name' => 'Musica'],
							['order' => 6, 'name' => 'Historia del Arte'],
							['order' => 7, 'name' => 'Pintores y Escultores'],
						],
					],
					[
						'data' => [
							'order' => 4,
							'name' => 'Humanidades',
						],
						'children' => [
							['order' => 1, 'name' => 'Derecho'],
							['order' => 2, 'name' => 'Filosofía'],
							['order' => 3, 'name' => 'Psicología y Educación'],
							['order' => 4, 'name' => 'Sociología'],
							['order' => 5, 'name' => 'PNL y Liderazgo'],
						],
					],
					[
						'data' => [
							'order' => 5,
							'name' => 'Arqueología',
						],
						'children' => [
							['order' => 1, 'name' => 'Textilería'],
							['order' => 2, 'name' => 'Arqueología Universal'],
						],
					],
				],
			],
			[
				'data' => [
					'order' => 6,
					'name' => 'Desarrollo Personal',
					'menu_title' => 'Libros de Desarrollo Personal',
				],
				'children' => [
					[
						'data' => [
							'order' => 1,
							'name' => 'Espiritualidad',
						],
						'children' => [
							['order' => 1, 'name' => 'Literatura Espiritual'],
							['order' => 2, 'name' => 'Religiones'],
						],
					],
					[
						'data' => [
							'order' => 2,
							'name' => 'Estilo de vida',
						],
						'children' => [
							['order' => 1, 'name' => 'Libros de Cocina'],
							['order' => 2, 'name' => 'Libros de Nutrición'],
							['order' => 3, 'name' => 'Guías de Viaje'],
							['order' => 4, 'name' => 'Manualidades'],
						],
					],
					[
						'data' => [
							'order' => 3,
							'name' => 'Formación',
						],
						'children' => [
							['order' => 1, 'name' => 'Guías de Embarazo'],
							['order' => 2, 'name' => 'Crianza de Bebés'],
							['order' => 3, 'name' => 'Crianza de Niños'],
							['order' => 4, 'name' => 'Menopausia'],
						],
					],
					[
						'data' => [
							'order' => 4,
							'name' => 'Salud',
						],
						'children' => [
							['order' => 1, 'name' => 'Divulgación Científica'],
							['order' => 2, 'name' => 'Ejercicios y Vida Saludable'],
							['order' => 3, 'name' => 'Deportes'],
						],
					],
					[
						'data' => [
							'order' => 5,
							'name' => 'Papelería',
						],
						'children' => [
							['order' => 1, 'name' => 'Agendas Anuales'],
							['order' => 2, 'name' => 'Bolsas de Tela'],
							['order' => 3, 'name' => 'Fundas de Libros'],
							['order' => 4, 'name' => 'Puzzles Adultos'],
						],
					],
				],
			],
		];

		foreach ($categoriesData as $categoryData)
		{
			$category = BookCategory::create($categoryData['data']);  /* @var $category BookCategory */

			foreach ($categoryData['children'] as $subcategoryData)
			{
				$subcategory = $category->children()->create($subcategoryData['data']);    /* @var $subcategory BookCategory */

				foreach ($subcategoryData['children'] as $subcategoryChildData)
					$subcategory->children()->create($subcategoryChildData);
			}
		}
    }
}

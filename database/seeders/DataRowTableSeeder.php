<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataRow;

class DataRowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Categoría Docente, Diplomado, Maestría, Doctorado
        $name = DataRow::create(['display_name' => 'Nombre', 'data_type' => 'string']);

        // Categoría Docente, Diplomado, Maestría, Doctorado
        $year = DataRow::create(['display_name' => 'Año', 'data_type' => 'number']);

        // Categoría Docente, Diplomado, Maestría, Doctorado, Artículo
        $place = DataRow::create(['display_name' => 'Lugar', 'data_type' => 'string']);

        // Maestría, Doctorado
        $research_title = DataRow::create(['display_name' => 'Título de la investigación', 'data_type' => 'string']);

        // Maestría, Doctorado, Artículo
        $tutor_name = DataRow::create(['display_name' => 'Tutor', 'data_type' => 'string']);

        // Maestría, Doctorado
        $consultant_name = DataRow::create(['display_name' => 'Consultante', 'data_type' => 'string']);

        // Artículo
        $article_type = DataRow::create(['display_name' => 'Tipo', 'data_type' => 'select', 'details' => '{\'options\':{0:\'Original\',1:\'Revisión\'}}']);

        // Artículo
        $title = DataRow::create(['display_name' => 'Título', 'data_type' => 'string']);

        // Artículo
        $date = DataRow::create(['display_name' => 'Fecha', 'data_type' => 'string']);

        // Artículo
        $published_in = DataRow::create(['display_name' => 'Tipo', 'data_type' => 'select', 'details' => '{\'options\':{0:\'Libro\',1:\'Actas de Evento\',2:\'Revista Científica\'}}']);

        // Artículo
        $editor_name = DataRow::create(['display_name' => 'Editor', 'data_type' => 'string']);

        // Artículo
        $event_name = DataRow::create(['display_name' => 'Evento', 'data_type' => 'string']);

        // Artículo
        $journal_name = DataRow::create(['display_name' => 'Revista', 'data_type' => 'string']);

        // Artículo
        $journal_indexing = DataRow::create(['display_name' => 'Indexada en', 'data_type' => 'select', 'details' => '{\'options\':{0:\'Scopus\',1:\'Web of Science\',2:\'SCielo\'}}', 'is_multiple' => 1]);

        // Artículo
        $journal_volume = DataRow::create(['display_name' => 'Volumen', 'data_type' => 'string']);

        // Artículo
        $journal_number = DataRow::create(['display_name' => 'Número', 'data_type' => 'string']);

        // Artículo
        $journal_pages = DataRow::create(['display_name' => 'Páginas', 'data_type' => 'string']);

        // Artículo
        $issn = DataRow::create(['display_name' => 'ISSN', 'data_type' => 'string']);

        // Artículo
        $doi = DataRow::create(['display_name' => 'DOI', 'data_type' => 'string']);


    }
}

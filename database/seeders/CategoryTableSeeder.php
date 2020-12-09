<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Academicos
        $academicos = Category::create(['title' => 'Resultados Académicos']);
        $academicos->children()->create(['title' => 'Categoría docente']);
        $academicos->children()->create(['title' => 'Diplomado']);
        $academicos->children()->create(['title' => 'Maestría']);
        $academicos->children()->create(['title' => 'Titulación académica']);
        $academicos->children()->create(['title' => 'Tribunales']);

        //Cientificos
        $cientificos = Category::create(['title' => 'Resultados Científicos']);
        $cientificos->children()->create(['title' => 'Categoría de investigador']);
        $cientificos->children()->create(['title' => 'Categoría Científica']);
        $publicaciones = $cientificos->children()->create(['title' => 'Publicaciones']);
        $publicaciones->children()->create(['title' => 'Artículos']);
        $publicaciones->children()->create(['title' => 'Pósters']);
        $publicaciones->children()->create(['title' => 'Libros']);

        //Extensionistas
        $extensionistas = Category::create(['title' => 'Resultados Extensionistas']);
        $extensionistas->children()->create(['title' => 'Colaboración con otras instituciones']);
        $extensionistas->children()->create(['title' => 'Participación en marchas y actividades de fechas conmemorativas']);

    }
}

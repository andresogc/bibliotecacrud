<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('libros')->insert([
            [
            'categoria_id' => '1',
            'titulo' => 'Cómo hacer que te pasen cosas buenas',
            'autor' => 'Annette Hess',
            'editorial' => 'Editorial Planeta',
            ],

            [
                'categoria_id' => '2',
            'titulo' => 'La casa alemana',
            'autor' => 'Kate Mosse',
            'editorial' => 'Editorial Planeta',
            ],

            [
                'categoria_id' => '3',
            'titulo' => 'La ciudad del fuego',
            'autor' => 'Srta. Bebi',
            'editorial' => 'Editorial Planeta',
            ],

            [
                'categoria_id' => '2',
            'titulo' => 'Memorias de una salvaje',
            'autor' => 'María Dueñas',
            'editorial' => 'Editorial Planeta',
            ],


            [
                'categoria_id' => '1',
            'titulo' => 'Las hijas del Capitán',
            'autor' => 'Cómo hacer que te pasen cosas buenas',
            'editorial' => 'Editorial Planeta',
            ],
            [
                'categoria_id' => '1',
                'titulo' => 'Las hijas del Capitán',
                'autor' => 'Gabriel García Márquez',
                'editorial' => 'Norma',
             ]



            ]);
    }
}

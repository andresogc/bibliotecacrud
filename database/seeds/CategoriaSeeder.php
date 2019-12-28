<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categorias')->insert([
            [

                'nombre' => 'Terror',
                'descripcion' => 'Libros de terror',
                'imagen' => 'no tiene',
            ],

            [
                'nombre' => 'Acción',
                'descripcion' => 'Libros de acción',
                'imagen' => 'no tiene',
            ],

            [
                'nombre' => 'Comedia',
                'descripcion' => 'Libros de comedia',
                'imagen' => 'no tiene',
            ],



            ]);
    }
}

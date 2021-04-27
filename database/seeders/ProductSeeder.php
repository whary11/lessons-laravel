<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert(
            [
           'id'             => 1,
           'name'           => 'Destornillador',
           'description'    => 'Detornillador de Pala 6x2 Negro Mango A',
           'slug'           => 'Herramientas-Hogar-Mecanica',
           'stock'          => 10,
           'price' =>12500,
           'image_url'    => '1-.',
           'status_id'    => 1,
            ],
            [
                'id'             => 2,
                'name'           => 'Bombillo',
                'description'    => 'bombillo Led ',
                'slug'           => 'Hogar-bombillo',
                'stock'          => 15,
                'price' =>2500,
                'image_url'    => '1-.',
                'status_id'    => 1,
            ],
            [
                'id'             => 3,
                'name'           => 'Lampara Led',
                'description'    => 'Lampara Led  Negro Mango A',
                'slug'           => 'Hogar-Lamparas',
                'stock'          => 10,
                'price' =>12500,
                'image_url'    => '1-.',
                'status_id'    => 1,
                ]

       );

    }


}

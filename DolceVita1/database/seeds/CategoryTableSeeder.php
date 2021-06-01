<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'descriere'=>'Tort',
            'um'=> 'kg',
        ]);
        Category::create([
            'descriere'=>'Macarons',
            'um'=> 'kg',
        ]);
        Category::create([
            'descriere'=>'Desert',
            'um'=> 'bucata',
        ]);
        Category::create([
            'descriere'=>'Tort',
            'um'=> 'kg',
        ]);
        Category::create([
            'descriere'=>'Croissant',
            'um'=> 'bucata',
        ]);

        Category::create([
            'descriere'=>'Ciocolata',
            'um'=> 'kg',
        ]);
        
        Category::create([
            'descriere'=>'Biscuiti',
            'um'=> 'kg',
        ]);

        Category::create([
            'descriere'=>'Auxiliar',
            'um'=> 'bucata',
        ]);
    }
}

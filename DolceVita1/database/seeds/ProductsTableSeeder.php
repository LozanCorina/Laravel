<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Products;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'nume'=>'Tort "Summer Time"',
            'descriere'=>'Tort glazurat cu frișcă și fructe',
            'img'=>'',
            'img_nutrition'=>'',
            'pret'=>60.00,
            'id_cat'=>1

        ]);
        Product::create([
            'nume'=>'Tort "Donuts Lover"',
            'descriere'=>'Tort decorat cu prajituri donuts',
            'img'=>'',
            'img_nutrition'=>'',
            'pret'=>75.00,
            'id_cat'=>1

        ]);
        Product::create([
            'nume'=>'Tort "Scortisoara"',
            'descriere'=>'Cheesecake cu lapte condesat si scortisoara',
            'img'=>'',
            'img_nutrition'=>'',
            'pret'=>53.00,
            'id_cat'=>1

        ]);

        Product::create([
            'nume'=>'Tort "Negresa"',
            'descriere'=>'Cheesecake din bezea cu ciocolată și cremă de mascarpone.  Alergeni: conține lapte, ouă, soia, alune, migdale. Poate conține urme de gluten, arahide.',
            'img'=>'',
            'img_nutrition'=>'',
            'pret'=>58.00,
            'id_cat'=>1

        ]);
    }
}

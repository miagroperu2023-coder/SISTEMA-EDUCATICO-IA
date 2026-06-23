<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Price::create([
            'name' => 'Gratis',
            'value' => 0,
        ]);

        Price::create([
            'name' => 'Nivel Escolar (N1)',
            'value' => 9.99,
        ]);

        Price::create([
            'name' => 'Nivel Escolar (N2)',
            'value' => 15.99,
        ]);

        Price::create([
            'name' => 'Nivel Escolar (N3)',
            'value' => 25.99,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CREANDO UN NUEVO REGISTRO DE USUARIO
        $user = User::create([
            'name' => 'Anthony Nuñez Canchari',
            'email' => 'anthony.anec@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $user = User::create([
            'name' => 'Mabell Nuñez',
            'email' => 'mabell@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $user = User::create([
            'name' => 'Frank Nuñez',
            'email' => 'frank@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $user = User::create([
            'name' => 'Cristian Molina',
            'email' => 'cristian@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $user = User::create([
            'name' => 'Irene Canchari',
            'email' => 'irene@gmail.com',
            'password' => bcrypt('123456')
        ]);

        //MNETODO DE SPATI está asignando el rol "Admin" a un usuario
        $user->assignRole('Admin');

        //GENERANDO 49 REGISTROS DEL FACTORY USER MAS 1 DE ARRIBA
        //User::factory(49)->create();
    }
}

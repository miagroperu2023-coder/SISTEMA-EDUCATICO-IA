<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //PRIMERO CREAR LOS ROLES Y PERMISOS QUE VA TENER EL USUARIO
        //POR ELLO SE LO COLOCA ARRIOBA
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);


        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);//LLAMANDO AL USERSEEDER

        $this->call(LevelSeeder::class);//LLAMANDO AL LEVELSEEDER

        $this->call(CategorySeeder::class);//LLAMANDO AL CATEGORYSEEDER

        $this->call(PriceSeeder::class);//LLAMANDO AL PRICESEEDER

        $this->call(PlatformSeeder::class);//LLAMANDO AL PLATFORMSEEDER

        $this->call(CourseSeeder::class);//LLAMANDO AL COURSESEEDER


      
        
    }
}

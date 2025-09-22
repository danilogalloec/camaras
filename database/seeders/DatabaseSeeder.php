<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si quieres crear usuarios de prueba, puedes descomentar lo de abajo
        // \App\Models\User::factory(10)->create();

        // Seeder de administrador
        $this->call(AdminSeeder::class);
    }
}

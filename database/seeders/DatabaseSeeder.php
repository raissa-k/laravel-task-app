<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Task::query()->insert([
            [
                'title' => 'Estudar roteamento',
                'description' => 'Entender como o router do Laravel funciona.',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Configurar Docker',
                'description' => 'Subir app + MySQL via docker compose.',
                'is_done' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Escrever README',
                'description' => null,
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'title' => 'Restaurante Sabor Mineiro',
                'description' => 'Um restaurante típico mineiro com comida caseira.',
                'images' => json_encode(['imagem 1.jpeg','imagem 2.jpeg','imagem 3.jpeg']),
                'cep' => '30140071',
                'address' => 'Av. Afonso Pena',
                'address_number' => '1234',
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'phone' => '(31) 3333-4444',
                'contact_email' => 'contato@sabormineiro.com',
                'category' => 'Restaurante',
                'features' => json_encode(['Wi-Fi grátis','Estacionamento']),
                'working_hours' => json_encode(['segunda-sexta' => '11:00-22:00']),
                'user_name' => 'Admin',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
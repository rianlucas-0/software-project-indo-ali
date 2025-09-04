<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Local;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Local::create([
            'title' => 'Restaurante Sabor Mineiro',
            'description' => 'Um restaurante típico mineiro com comida caseira.',
            'images' => ['imagem 1.jpeg','imagem 2.jpeg','imagem 3.jpeg'],
            'cep' => '30140071',
            'address' => 'Av. Afonso Pena',
            'address_number' => '1234',
            'neighborhood' => 'Centro',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'phone' => '(31) 3333-4444',
            'contact_email' => 'contato@sabormineiro.com',
            'category' => 'Restaurante',
            'features' => ['wifi','estacionamento','acessivel','ar_condicionado'],
            'working_hours' => ['segunda-sexta' => ['opening' => '11:00', 'closing' => '22:00']],
            'user_name' => 'Admin',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
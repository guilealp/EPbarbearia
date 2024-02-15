<?php

namespace Database\Seeders;

use App\Models\servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            servico::create([
                'name' => 'teste ' . $i,
                'descricao' => 'descriçao' . $i,
                'duracao' => $i,
                'preco' =>  "40.00",


            ]);
        }
    }
}

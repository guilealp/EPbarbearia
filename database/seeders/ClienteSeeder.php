<?php

namespace Database\Seeders;

use App\Models\clientes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            clientes::create([
                'name' => 'teste ' . $i,
                'celular' => '123456789',
                'email' => 'teste' . $i . '@hotmail.com',
                'cpf' => rand(00000000001, 99999999999),
                'dataNascimento' => '2007-05-08',
                'cidade' => 'cidade' . $i,
                'estado' => 'uf',
                'pais' => 'pais' . $i,
                'rua' => 'rua' . $i,
                'numero' => '1234',
                'bairro'  => 'bairro' . $i,
                'cep' => '12345678',
                'complemento' => 'complemento' . $i,
                'password' => Hash::make('123456'),

            ]);
        }
    }
}

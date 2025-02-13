<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::insert([
            [
                'tipo_documento' => 'CC',
            ],
            [
                'tipo_documento' => 'CE',
            ],
            [
                'tipo_documento' => 'NIT',
            ]
        ]);
    }
}

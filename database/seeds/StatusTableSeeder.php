<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Status::create([
            'name' => 'Pendente',
        ]);
        App\Status::create([
            'name' => 'Confirmado',
        ]);
        App\Status::create([
            'name' => 'Não solicitou',
        ]);
        App\Status::create([
            'name' => 'Faltou',
        ]);
    }
}

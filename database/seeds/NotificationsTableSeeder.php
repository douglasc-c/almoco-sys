<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Notification::create([
            'user_id' => 1,
            'description' => 'Lembre-se de confirmar almoço',
            'status' => 1,
        ]);

        App\Notification::create([
            'user_id' => 1,
            'description' => 'Almoço servido para equipe do TI',
            'status' => 1,
        ]);

        App\Notification::create([
            'user_id' => 1,
            'description' => 'Almoço servido para equipe do MKT',
            'status' => 1,
        ]);
    
        App\Notification::create([
            'user_id' => 1,
            'description' => 'Café servido para equipe do TI',
            'status' => 1,
        ]);

        App\Notification::create([
            'user_id' => 1,
            'description' => 'Café servido para equipe do MKT',
            'status' => 1,
        ]);
    }
}

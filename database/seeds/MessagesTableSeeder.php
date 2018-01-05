<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();
        Message::create([
                'nombre' => "Mateo",
                'email' => "mateo@mateo.com",
                'mensaje' => "Este es el mensaje del usuario Mateito"
            ]);
        for ($i=1; $i <101; $i++){
            Message::create([
                'nombre' => "Usuario {$i}",
                'email' => "usuario{$i}@email.com",
                'mensaje' => "Este es el mensaje del usuario No {$i}",
                'created_at' => Carbon::now()->subDays(100)->addDays($i)

            ]);
        }
    }
}

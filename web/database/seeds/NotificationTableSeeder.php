<?php

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\Notification;
use Faker\Factory;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $classes = Classe::all();

        foreach ($classes as $classe) {
            for ($i=1; $i < 7; $i++) {
                Notification::create([
                    'classe_id' => $classe->id,
                    'title' => $faker->sentence(2),
                    'content' => $faker->sentence(10),
                ]);
            }
        }
    }
}

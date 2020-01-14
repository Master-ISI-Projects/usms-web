<?php

use Illuminate\Database\Seeder;
use App\Models\ScholarYear;
use App\Models\Event;
use Faker\Factory;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $scholarYears = ScholarYear::all();

        foreach ($scholarYears as $scholarYear) {
            for ($i=1; $i < 6; $i++) {
                Event::create([
                    'scholar_year_id' => $scholarYear->id,
                    'title' => $faker->sentence(2),
                    'description' => $faker->sentence(10),
                    'start_at' => \Carbon\Carbon::now()->subDays(rand(2, 50)),
                    'duration' => rand(2, 8) . ' Heurs',
                    'image' => 'new_images/img-event-' . $i,
                ]);
            }
        }
    }
}


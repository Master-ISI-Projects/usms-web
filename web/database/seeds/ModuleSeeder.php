<?php

use Illuminate\Database\Seeder;
use App\Models\Semester;
use App\Models\Module;
use Faker\Factory;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $semesters = Semester::all();

        foreach ($semesters as $semester) {
            for ($i=1; $i < 7; $i++) {
                Module::create([
                    'semester_id' => $semester->id,
                    'name' => $faker->sentence(2),
                ]);
            }
        }
    }
}

<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolManager;
use App\Helpers\Constant;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(DepartementsOptionsEtcTableSeeder::class);
        // $this->call(ScholarYearSeeder::class);
        // $this->call(SchoolManagerSeeder::class);
        // $this->call(TeacherSeeder::class);
        // $this->call(StudentSeeder::class);
        // $this->call(ModuleSeeder::class);
        // $this->call(ClasseTableSeeder::class);
        // $this->call(NotificationTableSeeder::class);
        // $this->call(EventTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}

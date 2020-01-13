<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
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
        $faker = Factory::create();

        // for ($i=0; $i < 20; $i++) {
        //     $user = User::create([
        //         'first_name' => $faker->firstname,
        //         'last_name' => $faker->lastname,
        //         'gender' => Constant::USERS_GENDERS[mt_rand(0, (count(Constant::USERS_GENDERS)) - 1)],
        //         'tel' => $faker->phoneNumber,
        //         'email' => $faker->unique()->safeEmail,
        //         'password' => bcrypt('123456789'),
        //         'is_active' =>  mt_rand(0, 1),
        //         'role' => Constant::USER_ROLES['student']
        //     ]);

        //     $user->teacher()->save(
        //         Student::create([
        //             'apogee_number' => mt_rand(1000, 5000),
        //             'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        //         ])
        //     );
        // }

        $this->call(TeacherSeeder::class);

        $departements = ['Informatiques', 'Mathematiques', 'Economie', 'Physique', 'Biologie'];

        foreach ($departements as $departement) {
            App\Models\Departement::create([
                'name' => $departement,
                'teacher_id' => null
            ]);
        }

        // $this->call(StudentSeeder::class);
        // $this->call(DepartementTableSeeder::class);
        // $this->call(ScholarYearSeeder::class);
    }
}

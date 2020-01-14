<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Helpers\Constant;
use Faker\Factory;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=0; $i < 20; $i++) {
            $user = User::create([
                'first_name' => $faker->firstname,
                'last_name' => $faker->lastname,
                'gender' => Constant::USERS_GENDERS[mt_rand(0, (count(Constant::USERS_GENDERS)) - 1)],
                'tel' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123456789'),
                'is_active' =>  mt_rand(0, 1),
                'role' => Constant::USER_ROLES['student']
            ]);

            $user->student()->save(
                Student::create([
                    'apogee_number' => mt_rand(1000, 5000),
                    'birth_date' => \Carbon\Carbon::now()->subYears(rand(19, 25)),
                ])
            );
        }
    }
}

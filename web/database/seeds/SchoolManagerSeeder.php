<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\User;
use App\Models\SchoolManager;

class SchoolManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();

    	for ($i=0; $i < 5; $i++) {
	        $user = User::create([
	            'first_name' => $faker->firstname,
	            'last_name' => $faker->lastname,
	            'gender' => Constant::USERS_GENDERS[mt_rand(0, (count(Constant::USERS_GENDERS)) - 1)],
	            'tel' => $faker->phoneNumber,
	            'email' => $faker->unique()->safeEmail,
	            'password' => bcrypt('123456789'),
	            'is_active' =>  mt_rand(0, 1),
	            'role' => Constant::USER_ROLES['admin']
	        ]);

            $user->schoolManager()->save(
                SchoolManager::create()
            );
    	}
    }
}

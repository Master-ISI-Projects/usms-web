<?php

use Illuminate\Database\Seeder;
use App\Models\Departement;

class DepartementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departements = ['Informatiques', 'Mathematiques', 'Economie', 'Physique', 'Biologie'];

        foreach ($departements as $departement) {
            Departement::create([
                'name' => $departement,
                'teacher_id' => 25
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\ScholarYear;

class ScholarYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++) { 
	    	ScholarYear::create([
		        'scholar_year' => now()->addYears($i)->year . '-' . now()->addYears(1 + $i)->year, 
		        'start_at' => now()->addYears($i), 
		        'end_at' => now()->addYears(1 + $i),
	    	]);
    	}
    }
}

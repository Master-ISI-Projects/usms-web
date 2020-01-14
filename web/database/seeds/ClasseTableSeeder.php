<?php

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\ScholarYear;
use App\Models\Option;
use App\Models\Student;

class ClasseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scholarYears = ScholarYear::all();

        foreach ($scholarYears as $scholarYear) {
            $options = Option::all();

            foreach ($options as $option) {
                $d = 0;
                $b = 0;
                for ($i=1; $i < 5; $i++) {
                    $classe = Classe::create([
                        'scholar_year_id' => $scholarYear->id,
                        'option_id' => $option->id,
                        'name' => "Classe " . substr($option->name, 0, 10) . " - " . $i,
                    ]);

                    foreach ($option->semesters as $key => $semester) {
                        if(!empty($semester)) {
                            $classe->semesters()->attach($semester);
                        }
                    }

                    $d += rand(15, 17);
                    $students = Student::skip($b)->take($d)->get();
                    $b = $b + $d;

                    foreach ($students as $student) {
                        if(!empty($student)) {
                            $classe->students()->attach($student->id);
                        }
                    }
                }
            }
        }
    }
}

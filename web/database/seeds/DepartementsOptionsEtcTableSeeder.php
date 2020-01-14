<?php

use Illuminate\Database\Seeder;
use App\Models\Departement;
use App\Models\Option;
use App\Models\Semester;

class DepartementsOptionsEtcTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departements = [
            'Informatiques' => [
                'LEF Sciences Mathématiques et Informatiques',
                'LP TPW',
                'LP ISIL',
                'LP GLAASRI',
                'MASTER STRI',
                'MASTER ISI',
            ],
            'Mathematiques' => [
                'Mathematique Pure',
                'SMI',
                'Systeme d\'informatique',
                'Reseaux informatique',
            ],
            'Economie' => [
                "LEF Sciences Economiques et de Gestion",
                "LEF Droit Privé Section française",
                "LP Management des Entreprises agricoles et Agroalimentaires",
                "LP Marketing et Action Commerciale",
                "LP Management et Techniques logistiques du Commerce International",
                "LP Métiers de la Banque",
                "LP Gestion des Ressources Humaines",
                "MASTER Comptabilité Contrôle Audit",
                "MASTER Management des Ressources Humaines",
            ],
            'Physique' => [
                "LEF Sciences de la Matière Physique",
                "LEF Sciences de la Matière Chimie",
                "LP Energies Renouvelables",
                "MASTER Chimie de Formulation Industrielle",
                "MASTER Physique Moderne",
            ],
            'Biologie' => [
                "LEF Sciences de la vie",
            ],
            'Geologie' => []
        ];

        $semesters = ["Semestre 1", "Semestre 2"];

        foreach ($departements as $departement => $options) {
            $departementItem =  Departement::create([
                'name' => $departement,
            ]);

            foreach ($options as $option) {
                $optionItem = Option::create([
                    'name' => $option,
                    'departement_id' => $departementItem->id,
                ]);
                foreach ($semesters as $semester) {
                    Semester::create([
                        'name' => $semester,
                        'option_id' => $optionItem->id,
                    ]);
                }
            }
        }
    }
}

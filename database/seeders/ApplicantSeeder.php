<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample applicants
        $applicants = [
            [
                'first_name' => 'Mohamed',
                'last_name' => 'Amine',
                'email' => 'm.amine@example.com',
                'birth_date' => '1995-07-15',
                'birth_place' => 'Oujda',
                'id_card_number' => 'F123456',
                'phone_number' => '0612345678',
                'marital_status' => 'single',
                'years_of_experience' => 3,
                'education_level' => 'Licence en informatique',
                'status' => 'pending',
                'reference_number' => 'APP'.date('YmdHis').'1001',
                'notes' => 'Candidat très motivé, à contacter rapidement.',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'first_name' => 'Sara',
                'last_name' => 'Bouzid',
                'email' => 's.bouzid@example.com',
                'birth_date' => '1992-03-21',
                'birth_place' => 'Casablanca',
                'id_card_number' => 'B789012',
                'phone_number' => '0698765432',
                'marital_status' => 'married',
                'years_of_experience' => 5,
                'education_level' => 'Master en marketing',
                'status' => 'approved',
                'reference_number' => 'APP'.date('YmdHis').'1002',
                'notes' => 'Profil intéressant avec une bonne expérience.',
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'first_name' => 'Karim',
                'last_name' => 'Alaoui',
                'email' => 'k.alaoui@example.com',
                'birth_date' => '1997-11-10',
                'birth_place' => 'Rabat',
                'id_card_number' => 'C345678',
                'phone_number' => '0661029384',
                'marital_status' => 'single',
                'years_of_experience' => 2,
                'education_level' => 'Master en sciences des données',
                'status' => 'rejected',
                'reference_number' => 'APP'.date('YmdHis').'1003',
                'notes' => 'Profil ne correspondant pas aux critères recherchés.',
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'first_name' => 'Fatima',
                'last_name' => 'Zahra',
                'email' => 'f.zahra@example.com',
                'birth_date' => '1990-05-12',
                'birth_place' => 'Fès',
                'id_card_number' => 'D567890',
                'phone_number' => '0673294857',
                'marital_status' => 'divorced',
                'years_of_experience' => 7,
                'education_level' => 'Doctorat en gestion',
                'status' => 'approved',
                'reference_number' => 'APP'.date('YmdHis').'1004',
                'notes' => 'Candidate avec un excellent parcours académique.',
                'created_at' => Carbon::now()->subDays(8),
            ],
            [
                'first_name' => 'Ahmed',
                'last_name' => 'Hassan',
                'email' => 'a.hassan@example.com',
                'birth_date' => '1993-09-26',
                'birth_place' => 'Tanger',
                'id_card_number' => 'E123987',
                'phone_number' => '0689473625',
                'marital_status' => 'single',
                'years_of_experience' => 4,
                'education_level' => 'Licence en administration',
                'status' => 'pending',
                'reference_number' => 'APP'.date('YmdHis').'1005',
                'notes' => 'À convoquer pour un entretien téléphonique.',
                'created_at' => Carbon::now()->subDays(3),
            ],
        ];

        // Insert applicants
        foreach ($applicants as $applicant) {
            Applicant::create($applicant);
        }

        // Optionally create more random applicants
        // Uncomment this if you want more test data
        /*
        for ($i = 0; $i < 15; $i++) {
            $statusOptions = ['pending', 'approved', 'rejected'];
            $maritalOptions = ['single', 'married', 'divorced', 'widowed'];
            
            Applicant::create([
                'first_name' => 'Prénom' . ($i + 1),
                'last_name' => 'Nom' . ($i + 1),
                'email' => 'email' . ($i + 1) . '@example.com',
                'birth_date' => Carbon::now()->subYears(rand(20, 45))->subDays(rand(1, 365)),
                'birth_place' => 'Ville' . ($i % 5 + 1),
                'id_card_number' => 'CIN' . rand(10000, 99999),
                'phone_number' => '06' . rand(10000000, 99999999),
                'marital_status' => $maritalOptions[array_rand($maritalOptions)],
                'years_of_experience' => rand(0, 15),
                'education_level' => 'Niveau ' . ($i % 3 + 1),
                'status' => $statusOptions[array_rand($statusOptions)],
                'reference_number' => 'APP' . date('YmdHis') . (1006 + $i),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
        */
    }
}
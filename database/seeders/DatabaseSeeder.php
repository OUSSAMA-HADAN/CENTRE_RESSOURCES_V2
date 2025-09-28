<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        Admin::create([
            'name' => 'Admin',
            'email' => 'crp@markaz-oujda.com',
            'password' => Hash::make('Alihssan1446-1447'),
        ]);

        // Add more seed data as needed
        // $this->call([
        //     RechercheSeeder::class,
        //     DocumentationSeeder::class,
        //     FormationSeeder::class,
        // ]);
        // $this->call([
        //     ApplicantSeeder::class,
        // ]);
        // $this->call([
        //     RechercheSeeder::class,
        // ]);
    }
}
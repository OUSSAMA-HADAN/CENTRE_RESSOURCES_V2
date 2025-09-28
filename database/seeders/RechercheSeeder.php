<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RechercheSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recherches')->insert([
            [
                'title' => 'Introduction to AI',
                'slug' => Str::slug('Introduction to AI'),
                'summary' => 'A brief introduction to artificial intelligence and its applications.',
                'content' => 'Artificial Intelligence (AI) is the simulation of human intelligence in machines...',
                'category' => 'Technology',
                'published_at' => Carbon::now()->subDays(10),
                'is_published' => true,
                'cover_image' => 'ai_cover.jpg',
                'pdf_file' => 'ai_paper.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Climate Change Impacts',
                'slug' => Str::slug('Climate Change Impacts'),
                'summary' => 'Understanding the effects of climate change on the environment.',
                'content' => 'Climate change has led to rising temperatures, sea level rise, and more extreme weather events...',
                'category' => 'Environment',
                'published_at' => Carbon::now()->subDays(5),
                'is_published' => true,
                'cover_image' => 'climate_cover.jpg',
                'pdf_file' => 'climate_report.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

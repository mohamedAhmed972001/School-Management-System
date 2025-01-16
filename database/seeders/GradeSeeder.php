<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Grade::truncate();

        $grades = [
            ['en' => 'Primary stage', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'Middle school', 'ar' => 'المرحلة الإعدادية'],
            ['en' => 'High school', 'ar' => 'المرحلة الثانوية'],
        ];

        $notes = [
            'Covers grades from first to sixth primary.',
            'Covers grades from first to third preparatory.',
            'Covers grades from first to third secondary.',
        ];

        foreach ($grades as $index => $grade) {
            Grade::create([
                'Name' => $grade,
                'Notes' => $notes[$index],
            ]);
        }
    }
}

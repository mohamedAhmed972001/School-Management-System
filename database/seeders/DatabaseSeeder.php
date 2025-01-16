<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\API\TeacherController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GradeSeeder::class,
            ClassroomSeeder::class,
            SectionSeeder::class,
            GenderSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            ParentSeeder::class,
            ParentAttachmentSeeder::class,
            SpecializationSeeder::class,
            TeacherSeeder::class,
            TeacherSectionSeeder::class,
            StudentSeeder::class
        ]);
    }
}

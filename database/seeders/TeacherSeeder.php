<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'email' => 'teacher1@example.com',
                'password' => bcrypt('password123'),
                'Name' => ['en' => 'John Doe', 'ar' => 'جون دو'],
                'Specialization_id' => 1, // Assuming specialization ID exists
                'Gender_id' => 1, // Assuming gender ID exists
                'Joining_Date' => '2025-01-01',
                'Address' => 'Cairo, Egypt',
            ],
            [
                'email' => 'teacher2@example.com',
                'password' => bcrypt('password456'),
                'Name' => ['en' => 'Jane Smith', 'ar' => 'جين سميث'],
                'Specialization_id' => 2,
                'Gender_id' => 2,
                'Joining_Date' => '2025-01-02',
                'Address' => 'Alexandria, Egypt',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}


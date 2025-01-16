<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classrooms = [
            [
                'Name' => json_encode(['en' => 'Primary 1', 'ar' => 'الصف الأول الابتدائي']),
                'Notes' => 'Classroom for Primary 1',
                'Grade_id' => 1,
            ],
            [
                'Name' => json_encode(['en' => 'Primary 2', 'ar' => 'الصف الثاني الابتدائي']),
                'Notes' => 'Classroom for Primary 2',
                'Grade_id' => 1,
            ],
            [
                'Name' => json_encode(['en' => 'Primary 3', 'ar' => 'الصف الثالث الابتدائي']),
                'Notes' => 'Classroom for Primary 3',
                'Grade_id' => 1,
            ],
            [
                'Name' => json_encode(['en' => 'Primary 4', 'ar' => 'الصف الرابع الابتدائي']),
                'Notes' => 'Classroom for Primary 4',
                'Grade_id' => 1,
            ],
            [
                'Name' => json_encode(['en' => 'Primary 5', 'ar' => 'الصف الخامس الابتدائي']),
                'Notes' => 'Classroom for Primary 5',
                'Grade_id' => 1,
            ],
            [
                'Name' => json_encode(['en' => 'Primary 6', 'ar' => 'الصف السادس الابتدائي']),
                'Notes' => 'Classroom for Primary 6',
                'Grade_id' => 1,
            ],
            [
                'Name' => json_encode(['en' => 'Prep 1', 'ar' => 'الصف الأول الإعدادي']),
                'Notes' => 'Classroom for Prep 1',
                'Grade_id' => 2,
            ],
            [
                'Name' => json_encode(['en' => 'Prep 2', 'ar' => 'الصف الثاني الإعدادي']),
                'Notes' => 'Classroom for Prep 2',
                'Grade_id' => 2,
            ],
            [
                'Name' => json_encode(['en' => 'Prep 3', 'ar' => 'الصف الثالث الإعدادي']),
                'Notes' => 'Classroom for Prep 3',
                'Grade_id' => 2,
            ],
            [
                'Name' => json_encode(['en' => 'Secondary 1', 'ar' => 'الصف الأول الثانوي']),
                'Notes' => 'Classroom for Secondary 1',
                'Grade_id' => 3,
            ],
            [
                'Name' => json_encode(['en' => 'Secondary 2', 'ar' => 'الصف الثاني الثانوي']),
                'Notes' => 'Classroom for Secondary 2',
                'Grade_id' => 3,
            ],
            [
                'Name' => json_encode(['en' => 'Secondary 3', 'ar' => 'الصف الثالث الثانوي']),
                'Notes' => 'Classroom for Secondary 3',
                'Grade_id' => 3,
            ],
        ];

        DB::table('classrooms')->insert($classrooms);
    }
}

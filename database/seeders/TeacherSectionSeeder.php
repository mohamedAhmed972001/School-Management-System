<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إدخال بيانات تجريبية
        DB::table('teacher_section')->insert([
            [
                'Teacher_id' => 2,
                'Section_id' => 1,
            ],
            [
                'Teacher_id' => 1,
                'Section_id' => 2,
            ],
            [
                'Teacher_id' => 2,
                'Section_id' => 1,
            ],
            // أضف المزيد من البيانات حسب الحاجة
        ]);
    }
}

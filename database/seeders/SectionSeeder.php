<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            [
                'Name' => json_encode(['en' => '1/1', 'ar' => '١/١']),
                'Status' => 1,
                'Grade_id' => 1,
                'Classroom_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Name' => json_encode(['en' => '2/3', 'ar' => '٢/٣']),
                'Status' => 1,
                'Grade_id' => 2,
                'Classroom_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

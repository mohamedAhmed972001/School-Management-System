<?php
namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;

use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Student::create([
            'Name' => ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'],
            'email' => 'Ahmed_Ibrahim@yahoo.com',
            'password' => bcrypt('password123'),
            'Gender_id' => rand(1, 2),
            'Nationality_id' => rand(1, 10),
            'Date_Birth' => date('1995-01-01'),
            'Grade_id' => rand(1, 3),
            'Classroom_id' => rand(1, 5),
            'Section_id' => rand(1, 2),
            'Parent_id' => 1,
            'Academic_Year' => '2021',
            'Religion_id'=>1

        ]);
    }
}

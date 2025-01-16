<?php

namespace Database\Seeders;

use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Parent::truncate();

        $parents = [
            [
                'email' => 'parent1@yahoo.com',
                'password' => bcrypt('12345678'),
                'Name_Father' => ['en' => 'Emad Mohamed', 'ar' => 'عماد محمد'],
                'National_ID_Father' => '1234567890',
                'Passport_ID_Father' => '1234567890',
                'Phone_Father' => '1234567890',
                'Job_Father' => ['en' => 'Programmer', 'ar' => 'مبرمج'],
                'Nationality_Father_id' => Nationality::all()->random()->id,
                'Religion_Father_id' => Religion::all()->random()->id,
                'Address_Father' => 'القاهرة',
                'Name_Mother' => ['en' => 'SS', 'ar' => 'سس'],
                'National_ID_Mother' => '0987654321',
                'Passport_ID_Mother' => '0987654321',
                'Phone_Mother' => '0987654321',
                'Job_Mother' => ['en' => 'Teacher', 'ar' => 'معلمة'],
                'Nationality_Mother_id' => Nationality::all()->random()->id,
                'Religion_Mother_id' => Religion::all()->random()->id,
                'Address_Mother' => 'الجيزة',
            ],
            // يمكن إضافة المزيد من الآباء بنفس الطريقة
        ];

        foreach ($parents as $parent) {
            MyParent::create($parent);
        }
    }
}

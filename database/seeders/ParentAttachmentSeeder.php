<?php

namespace Database\Seeders;

use App\Models\ParentAttachment;
use App\Models\MyParent;
use Illuminate\Database\Seeder;

class ParentAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // الحصول على قائمة الآباء المتوفرين
        $parents = MyParent::all();

        foreach ($parents as $parent) {
            ParentAttachment::create([
                'File_name' => 'document_' . $parent->id . '.pdf', // اسم مرفق افتراضي
                'Parent_id' => $parent->id,
            ]);
        }
    }
}

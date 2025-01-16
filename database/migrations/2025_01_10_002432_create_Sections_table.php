<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sections', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->comment('Section name (e.g., 1/1, 2/3)');
            $table->boolean('Status')->default(true)->comment('Section status: true for active, false for inactive');
            // تعديل نوع البيانات إلى unsignedBigInteger
            $table->unsignedInteger('Grade_id');
            $table->unsignedInteger('Classroom_id');

            // إضافة قيد المفتاح الخارجي
            $table->foreign('Grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('Classroom_id')->references('id')->on('classrooms')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}

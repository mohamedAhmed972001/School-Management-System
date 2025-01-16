<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Teacher_Section', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Teacher_id');
            $table->unsignedBigInteger('Section_id');

            // foreign keys
            $table->foreign('Teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_section');
    }
}

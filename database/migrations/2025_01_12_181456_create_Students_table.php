<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Students', function (Blueprint $table) {
            $table->id();  // عمود auto_increment
            $table->text('Name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('Gender_id')->unsigned();
            $table->foreign('Gender_id')->references('id')->on('Genders')->onDelete('cascade');
            $table->bigInteger('Nationality_id')->unsigned();
            $table->foreign('Nationality_id')->references('id')->on('Nationalities')->onDelete('cascade');
            $table->date('Date_Birth');
            $table->unsignedInteger('Grade_id');  // تغيير من bigInteger إلى unsignedInteger
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->unsignedInteger('Classroom_id')->unsigned();
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->bigInteger('Section_id')->unsigned();
            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger('Parent_id')->unsigned();
            $table->foreign('Parent_id')->references('id')->on('MyParents')->onDelete('cascade');
            //$table->bigInteger('Religion_id');
            $table->foreignId('Religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->string('Academic_Year');
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}

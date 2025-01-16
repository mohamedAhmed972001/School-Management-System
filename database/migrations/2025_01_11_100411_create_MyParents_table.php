<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MyParents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // Father information
            $table->string('Name_Father');
            $table->string('National_ID_Father');
            $table->string('Passport_ID_Father');
            $table->string('Phone_Father');
            $table->string('Job_Father');
            $table->unsignedBigInteger('Nationality_Father_id');
            $table->unsignedBigInteger('Religion_Father_id');
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('Religion_Father_id')->references('id')->on('religions')->onDelete('cascade');
            $table->string('Address_Father');

            // Mother information
            $table->string('Name_Mother');
            $table->string('National_ID_Mother');
            $table->string('Passport_ID_Mother');
            $table->string('Phone_Mother');
            $table->string('Job_Mother');
            $table->unsignedBigInteger('Nationality_Mother_id');
            $table->unsignedBigInteger('Religion_Mother_id');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions')->onDelete('cascade');
            $table->string('Address_Mother');

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
        Schema::dropIfExists('MyParents');
    }
}

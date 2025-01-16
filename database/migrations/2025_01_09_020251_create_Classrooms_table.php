<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration {

	public function up()
	{
        Schema::create('Classrooms', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('Name');
            $table->text('Notes')->nullable();
            $table->unsignedInteger('Grade_id');
            $table->foreign('Grade_id')
                ->references('id')
                ->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
	}

	public function down()
	{
		Schema::drop('Classrooms');
	}
}

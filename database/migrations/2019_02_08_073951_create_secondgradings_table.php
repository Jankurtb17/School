<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondgradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondgradings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('gradeLevel');
            $table->string('schoolYear');
            $table->string('gradingperiod');
            $table->string('className');
            $table->string('subjectCode');
            $table->string('grade');
            $table->string('employee_id');
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
        Schema::dropIfExists('secondgradings');
    }
}

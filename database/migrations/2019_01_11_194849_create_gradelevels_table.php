<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradelevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradelevels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gradeLevel');
            $table->string('subjectName1');
            $table->string('subjectName2');
            $table->string('subjectName3');
            $table->string('subjectName4');
            $table->string('subjectName5');
            $table->string('subjectName6');
            $table->string('subjectName7');
            $table->string('subjectName8');
            $table->string('subjectName9');
            $table->string('subjectName10');
            $table->string('subjectName11');
            $table->string('subjectName12');
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
        Schema::dropIfExists('gradelevels');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->unsignedBigInteger('school_year_id');
            $table->foreign('school_year_id')->references('id')->on('school_years');
            $table->unsignedBigInteger('strand_id')->nullable();
            $table->foreign('strand_id')->references('id')->on('strands');
            $table->string("term")->nullable();
            $table->string("grade_level")->nullable();
            $table->string("curriculum")->nullable();
            $table->string("student_type")->nullable();
            $table->string("date_of_enroll");
            $table->string("enroll_status")->default('Pending');
            $table->string("action_taken")->nullable();
            $table->string("tracking_no")->nullable();
            $table->string("state")->nullable();
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
        Schema::dropIfExists('enrollments');
    }
}

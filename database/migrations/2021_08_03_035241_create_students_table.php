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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('roll_no', 45)->unique();
            $table->string('student_type', 45)->nullable();
            $table->string('student_firstname')->nullable();
            $table->string('student_middlename')->nullable();
            $table->string('student_lastname')->nullable();
            $table->string('date_of_birth', 45)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('contact', 45)->nullable();
            $table->string('gender', 45)->nullable();
            $table->string('martial_status', 45)->nullable();
            $table->string('nationality', 45)->nullable();
            $table->string('religion', 45)->nullable();
            $table->string('address')->nullable();
            $table->string('username', 45)->nullable();
            $table->string('password')->nullable();
            $table->string('student_status')->nullable();
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

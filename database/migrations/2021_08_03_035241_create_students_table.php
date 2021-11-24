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
            // $table->string('curriculum', 45)->nullable();
            $table->string('student_firstname')->nullable();
            $table->string('student_middlename')->nullable();
            $table->string('student_lastname')->nullable();
            $table->string('date_of_birth', 45)->nullable();
            $table->string('student_contact', 45)->nullable();
            $table->string('gender', 45)->nullable();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            // $table->string('last_school_attended')->nullable();
            $table->string('last_schoolyear_attended')->nullable();
            $table->string('isbalik_aral')->default('No');
            $table->string('mother_name')->nullable();
            $table->string('mother_contact_no')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_contact_no')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact_no')->nullable();
            $table->string('username', 45)->nullable();
            $table->string('orig_password')->nullable();
            $table->string('password')->nullable();
            $table->string('student_status', 5)->nullable();
            $table->string('req_grade')->nullable();
            $table->string('req_psa')->nullable();
            $table->string('req_goodmoral')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('completer', 5)->default('No');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('school_id_no', 45)->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_region')->nullable();
            $table->string('school_division')->nullable();
            $table->string('school_address')->nullable();
            $table->string('school_logo')->nullable();
            $table->boolean('school_enrollment_url')->default(true);
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
        Schema::dropIfExists('school_profiles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('strand_id')->nullable();
            $table->foreign('strand_id')->references('id')->on('strands');
            $table->tinyInteger('grade_level')->nullable();
            $table->string('subject_code', 45)->nullable();
            $table->string('descriptive_title')->nullable();
            $table->string('subject_for', 45)->nullable();
            $table->string('indicate_type', 45)->nullable();
            $table->unsignedBigInteger('prerequisite')->nullable();
            $table->foreign('prerequisite')->references('id')->on('subjects');
            $table->string('term', 45)->nullable();
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
        Schema::dropIfExists('subjects');
    }
}

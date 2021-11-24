<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->tinyInteger('first')->nullable();
            $table->tinyInteger('second')->nullable();
            $table->tinyInteger('third')->nullable();
            $table->tinyInteger('fourth')->nullable();
            $table->tinyInteger('avg')->nullable();
            $table->string('term',10)->nullable();
            $table->string('avg_now',10)->nullable();
            $table->string('remarks',10)->nullable();
            $table->string('conducted_from',20)->nullable();
            $table->string('conducted_to',20)->nullable();
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
        Schema::dropIfExists('grades');
    }
}

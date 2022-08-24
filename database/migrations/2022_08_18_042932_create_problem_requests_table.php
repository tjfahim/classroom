<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('subject');
            $table->string('image')->nullable();
            $table->string('date')->nullable();
            $table->boolean('status')->deafult(0)->nullable();
            $table->timestamps();
            // $table->bigInteger('student_id')->unsigned()->nullable();


            // $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('student_id')->constrained('users');
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem-requests');
    }
};

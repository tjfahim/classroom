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
            $table->string('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->boolean('status')->deafult(0);
            $table->timestamps();

            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade')->nullable();

            $table->foreignId('users_id')->constrained()->nullable();
            // $table->foreignId('teacher_id')->constrained()->nullable();
            // $table->foreignId('teacher_id')->constrained()->nullable();
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

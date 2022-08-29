<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPSTORM_META\type;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->integer('role')->default(0);
            $table->rememberToken();
            $table->string('type');
            $table->string('gender')->nullable();
            $table->date('birth_of_date')->nullable();
            $table->string('religion')->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('student_id')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->string('designation')->nullable();
            $table->string('qualification')->nullable();
            $table->string('university')->nullable();
      

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
        Schema::dropIfExists('users');
    }




};

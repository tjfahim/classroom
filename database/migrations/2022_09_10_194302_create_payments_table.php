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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stdt_id')->unsigned();
            $table->bigInteger('prblm_id')->unsigned();
            $table->enum('status',['pending','approved','declined','refunded'])->default('pending');
            $table->timestamps();
            $table->foreign('stdt_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('prblm_id')->references('id')->on('problem_requests')->onDelete('cascade');
            $table->string('charge_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};

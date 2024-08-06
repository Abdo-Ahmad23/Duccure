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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('assets/img/doctors/doctor-thumb-02.jpg');
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('bio')->nullable();
            $table->string('pricing')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('doctors');
    }
};
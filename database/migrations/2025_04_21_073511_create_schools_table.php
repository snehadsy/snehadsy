<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->unsignedBigInteger('state_xid');
            $table->unsignedBigInteger('district_xid');
            $table->unsignedBigInteger('city_xid');
            $table->date('established_at');
            $table->string('login_id')->unique();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('state_xid')->references('id')->on('states');
            // $table->foreign('district_xid')->references('id')->on('districts');
            // $table->foreign('city_xid')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};

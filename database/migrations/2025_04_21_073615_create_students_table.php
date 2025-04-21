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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_xid');
            $table->string('name');
            $table->unsignedBigInteger('standard_xid');
            $table->enum('gender', ['male', 'female']);
            $table->string('contact');
            $table->year('year');
            $table->string('image')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('school_xid')->references('id')->on('schools')->onDelete('cascade');
            // $table->foreign('standard_xid')->references('id')->on('standards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('image')->nullable();
            $table->string('salary')->nullable();
            // $table->unsignedBigInteger('manager_id');
            // $table->unsignedBigInteger('department_id');
            $table->foreignId('manager_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('department_id')->references('id')->on('departments')->onDelete('restrict');

            // $table->foreignId('department_id')->constrained();

            // $table->foreignId('manager_id')->constrained('users')->onDelete('set null');
            // $table->foreignId('department_id')->references('id')->on('departments')->constrained('departments')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

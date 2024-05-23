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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assign_by'); // Assuming this references a user ID
            $table->unsignedBigInteger('assign_to'); // Assuming this references a user ID
            $table->date('dead_line'); // Using date type for deadlines
            $table->text('description'); // Using text type for potentially longer descriptions
            $table->string('status');
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('assign_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assign_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

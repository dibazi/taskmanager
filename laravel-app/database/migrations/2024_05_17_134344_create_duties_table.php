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
        Schema::create('duties', function (Blueprint $table) {
            $table->id();
            $table->string('assign_by'); // Assuming this references a user ID
            $table->string('assign_to'); // Assuming this references a user ID
            $table->date('dead_line'); // Using date type for deadlines
            $table->text('description'); // Using text type for potentially longer descriptions
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duties');
    }
};

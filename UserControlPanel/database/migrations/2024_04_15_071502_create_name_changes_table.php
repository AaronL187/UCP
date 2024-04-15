<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('name_changes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->useCurrent();  // Date of the change
            $table->unsignedBigInteger('character_id');  // Foreign key from characters table
            $table->string('old_name', 255);  // Old name of the character
            $table->string('new_name', 255);  // New name of the character
            $table->text('reason');  // Reason for the name change
            $table->string('handled_by');  // Admin's name who handled the change

            // Adding the status column: 0 is declined, 1 is accepted, NULL is pending
            $table->tinyInteger('status')->nullable()->default(null);  // Status column

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_changes');
    }
};

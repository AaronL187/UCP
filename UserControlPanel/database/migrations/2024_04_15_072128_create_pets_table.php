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
        Schema::connection('gs_data')->create('pets', function (Blueprint $table) {
            $table->id('petid'); // 'id' renamed to 'petid', auto-incrementing
            $table->unsignedBigInteger('owner_id')->constrained('characters');; // Unsigned BigInteger for referencing the character id
            $table->string('pettype', 7); // VARCHAR equivalent in Laravel, max length 7
            $table->tinyInteger('hunger'); // TINYINT type for storing small integer values
            $table->tinyInteger('thirst'); // TINYINT type for storing small integer values
            $table->string('name', 50); // VARCHAR equivalent, max length 50
            $table->timestamps(); // Optional, creates 'created_at' and 'updated_at' columns

            $table->foreign('owner_id', 'pets_owner_id_fk')
                ->references('id')->on('characters')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('gs_data')->dropIfExists('pets');
    }
};

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
        Schema::connection('gs_data')->create('factions', function (Blueprint $table) {
            $table->id(); // Correctly sets it as an auto-incrementing unsigned BIGINT primary key
            $table->tinyInteger('factiontype')->nullable();
            $table->string('name', 255)->nullable();
            $table->json('factiondata')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        #Schema::connection('gs_data')->dropIfExists('factions');
    }
};

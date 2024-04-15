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
        Schema::connection('gs_data')->create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('charactername');
            $table->unsignedBigInteger('account');
            $table->decimal('x', 10, 6);
            $table->decimal('y', 10, 6);
            $table->decimal('z', 10, 6);
            $table->unsignedTinyInteger('health')->default(100);
            $table->unsignedTinyInteger('armor')->default(1);
            $table->timestamp('last_login_time')->nullable();
            $table->unsignedTinyInteger('hunger')->default(100);
            $table->unsignedTinyInteger('thirst')->default(100);
            $table->string('adminnick')->default('Ismeretlen');
            $table->unsignedBigInteger('dimension_id')->default(0);
            $table->unsignedBigInteger('money'); // For values over 2 billion
            $table->unsignedInteger('pp'); // Assuming premium points won't exceed 2^32
            $table->unsignedInteger('skin_id');
            $table->unsignedInteger('age');
            $table->unsignedTinyInteger('maxvehs');
            $table->unsignedTinyInteger('maxinteriors');
            $table->unsignedBigInteger('faction_id')->nullable();
            $table->unsignedBigInteger('petID')->nullable();
            $table->json('chatblock')->nullable();
            $table->timestamps();

            $table->foreign('account', 'characters_account_id_fk')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('faction_id', 'characters_faction_id_fk')
                ->references('id')->on('factions')
                ->onDelete('set null');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};

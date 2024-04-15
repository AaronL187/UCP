<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('gs_data')->create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->tinyInteger('r')->unsigned();
            $table->tinyInteger('g')->unsigned();
            $table->tinyInteger('b')->unsigned();
            $table->decimal('x', 10, 6);
            $table->decimal('y', 10, 6);
            $table->decimal('z', 10, 6);
            $table->json('tuning');
            $table->integer('dimension');
            $table->integer('interior');
            $table->unsignedBigInteger('faction_id')->nullable();
            $table->boolean('impound')->default(false);
            $table->integer('paintjob')->nullable();
            $table->json('deletion_info')->nullable();
            $table->timestamps();

            // Explicitly naming the foreign key constraint to ensure uniqueness
            $table->foreign('owner_id', 'vehicles_owner_id_fk')
                ->references('id')->on('characters')
                ->onDelete('cascade');

            // Similarly, ensure any other foreign key constraints are uniquely named
            if (Schema::hasColumn('vehicles', 'faction_id')) {
                $table->foreign('faction_id', 'vehicles_faction_id_fk')
                    ->references('factionID')->on('factions')
                    ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::connection('gs_data')->dropIfExists('vehicles');
    }
};

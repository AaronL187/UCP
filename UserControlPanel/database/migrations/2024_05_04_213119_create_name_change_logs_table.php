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
        Schema::connection('gs_log')->create('name_change_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->comment('A log rögzítésének időpontja');
            $table->string('type')->comment('A log típusa, például "Járműeladás"');
            $table->integer('character')->comment('A karakter azonosítója');
            $table->json('message')->comment('A log tartalmának részletes leírása');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_change_logs');
    }
};

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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_by');
            $table->string('problem');
            $table->boolean('status')->nullable()->default(null)->comment('null = pending, 1 = accepted, 0 = rejected');
            $table->integer('handled_by')->nullable()->default(null);
            $table->string('reason')->nullable()->default(null);
            $table->string('proofurl')->nullable()->default(null)->comment('URL to the proof of the problem');
            $table->timestamp('handled_at')->nullable()->default(null);
            $table->integer('reward')->default(0)->comment('Reward for the suggestion being accepted.')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

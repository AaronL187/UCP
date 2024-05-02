<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complained_by');
            $table->unsignedBigInteger('complained_against');
            $table->string('title');
            $table->text('description');
            $table->string('prooflink')->nullable();
            $table->boolean('status')->nullable()->default(null)->comment('null = pending, 1 = accepted, 0 = rejected');
            $table->unsignedBigInteger('handled_by')->nullable();
            $table->string('resolution')->nullable();
            $table->timestamp('handled_at')->nullable();
            $table->json('messages')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

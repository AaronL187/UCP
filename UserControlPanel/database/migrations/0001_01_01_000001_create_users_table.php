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

        Schema::connection('gs_data')->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('serial', 32)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ucp_ip');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedTinyInteger('adminlevel')->default(0); // A number from 0-15, default is 0
            $table->boolean('banned')->default(false); // A bit, you can use boolean for this, default is false (not banned)
            $table->string('ban_reason')->nullable(); // A string, can be nullable
            $table->json('jaildata')->nullable(); // A JSON column, can be nullable
            $table->string('factorcode')->nullable(); // Assuming this is a string related to 2FA, can be nullable
            $table->json('warndata')->nullable(); // Another JSON column, can be nullable
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};


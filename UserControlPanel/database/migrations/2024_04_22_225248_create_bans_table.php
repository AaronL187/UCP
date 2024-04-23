<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gs_data')->create('bans', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->unsignedBigInteger('userid');  // Assuming a 'users' table exists
            $table->string('username'); // Username of the banned user
            $table->timestamp('banned_until')->nullable(); // Null if the ban is permanent
            $table->boolean('is_banned')->default(true);    // True if the user is banned
            $table->text('banned_by');  // Admin who banned the user
            $table->text('reason'); // Reason for ban
            $table->text('unbanned_by')->nullable()->default(null);
            $table->timestamps();  // Adds created_at and updated_at columns
            $table->softDeletes();  // Adds deleted_at column

            $table->foreign('userid', 'banlist_userid_id_fk')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('gs_data')->dropIfExists('bans');
    }
}

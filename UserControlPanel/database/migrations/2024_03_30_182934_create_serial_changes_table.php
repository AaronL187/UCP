<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerialChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gs_ucp')->create('serial_changes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->useCurrent(); // Date of the change
            $table->unsignedBigInteger('character_id'); // Foreign key from characters table
            $table->string('old_serial', 32); // Old serial 32 Hexadecimal Number
            $table->string('new_serial', 32); // New Serial 32 Hexadecimal Number
            $table->text('reason'); // Reason for the change
            $table->string('handled_by'); // Admin's name who handled the change

            // Adding the status column: 0 is declined, 1 is accepted, NULL is pending
            $table->tinyInteger('status')->nullable()->default(null); // Status column

            // Omit the foreign key constraint due to cross-database limitations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('gs_ucp')->dropIfExists('serial_changes');
    }
}

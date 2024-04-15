<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('gs_data')->create('interiors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('name', 255);  // Name of the interior
            $table->decimal('x', 10, 6);  // X coordinate
            $table->decimal('y', 10, 6);  // Y coordinate
            $table->decimal('z', 10, 6);  // Z coordinate
            $table->decimal('size', 8, 2);  // Size or area of the interior
            $table->integer('dimension');  // Dimension identifier
            $table->integer('interior');  // Interior type or identifier
            $table->unsignedBigInteger('created_by');  // Who created the interior
            $table->dateTime('creation_date');  // When the interior was created
            $table->unsignedBigInteger('faction_id')->nullable()->constrained('factions');;  // Associated faction
            $table->string('type', 50);  // Type of the interior
            $table->unsignedBigInteger('price')->default(1000000);  // Price of the interior with a default value of 1,000,000
            $table->boolean('for_sale')->default(false);  // Whether the interior is for sale
            $table->timestamps();

            $table->foreign('owner_id', 'interiors_owner_id_fk')
                ->references('id')->on('characters')
                ->onDelete('cascade');


        });
    }

    public function down(): void
    {
        Schema::connection('gs_data')->dropIfExists('interiors');
    }
};

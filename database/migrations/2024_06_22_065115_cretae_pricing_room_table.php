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
        Schema::create('pricing_room', function (Blueprint $table) {
            //  foreign key of Outfits table
            $table->unsignedBigInteger('pricing_id');
            $table->foreign('pricing_id')
                  ->references('id')
                  ->on('pricings')
                  ->onUpdate('cascade')
                  ->onDelete('no action');

            //  foreign key of Rooms table
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
                  ->references('id')
                  ->on('rooms')
                  -> onUpdate('cascade')
                  ->onDelete('no action');
            
            $table->primary(['pricing_id', 'room_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_room');
    }
};

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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('amount')->default(0);
            $table->integer('amount_ttc')->default(0);
            $table->string('option');
            $table->integer('outfit_quantity')->default(1);
            $table->string('currency')->default('Fcfa');
            $table->string('status')->default('pending');

            $table->foreignId('pricing_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
                
            $table->foreignId('room_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
                
            $table->foreignId('outfit_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
                

            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')
                     ->references('id')
                     ->on('users')
                     ->onDelete('no action')
                     ->onUpdate('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

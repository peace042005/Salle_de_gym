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
        Schema::create('outfits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->integer('sale_price');
            $table->string('currency')->default('Fcfa');
            $table->text('cover_image');
            $table->boolean('status')->default(true);

            // foreign key : $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('no action');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfits');
    }
};

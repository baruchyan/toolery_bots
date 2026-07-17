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
        Schema::create('telegram_bot_commands', function (Blueprint $table) {
            $table->id();

            $table->boolean('is_active')
                ->default(false);

            $table->foreignId('bot_id')
                ->references('id')
                ->on('telegram_bots')
                ->onDelete('cascade');

            $table->string('command');

            $table->string('answer')
                ->nullable();

            $table->string('handler')
                ->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_bot_commands');
    }
};

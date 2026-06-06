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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip_address');
            $table->string('country');
            $table->string('city');
            $table->string('browser');
            $table->string('os');
            $table->string('device');
            $table->string('referer');
            $table->dateTime('clicked_at');
            $table->foreignId('short_link_id')
                    ->constrained('short_links')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};

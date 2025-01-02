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
        Schema::create('influencers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influncers_group_id');
            $table->string('influnencer_id');
            $table->string('platform');
            $table->longText('content');
            // $table->string('email')->unique();
            // $table->string('platform');
            // $table->string('profile_url');
            // $table->integer('followers_count');
            // $table->decimal('engagement_rate', 5, 2);
            // $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencers');
    }
};

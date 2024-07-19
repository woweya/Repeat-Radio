<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('profile_picture_path')->nullable();
            $table->string('banner_picture_path')->nullable();
            $table->dropColumn('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('profile_picture_path');
            $table->dropColumn('banner_picture_path');
            $table->string('path')->nullable();
        });
    }
};


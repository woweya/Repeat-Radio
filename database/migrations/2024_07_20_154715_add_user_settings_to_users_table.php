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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('about_me')->default(false);
            $table->boolean('social_infos')->default(false);
            $table->boolean('contact_infos')->default(false);
            $table->boolean('private_profile')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('about_me');
            $table->dropColumn('social_infos');
            $table->dropColumn('contact_infos');
            $table->dropColumn('private_profile');
        });
    }
};

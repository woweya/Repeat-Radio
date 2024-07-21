<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->foreign('reply_to')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['reply_to']);
            $table->dropColumn('reply_to');
        });
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoryNonaem2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            \DB::statement("
        ALTER TABLE categories CHANGE nonaem nonaem ENUM('a','b','c') DEFAULT 'b'
    ");
        });
            \DB::statement("
        ALTER TABLE posts ALTER moderation moderation ENUM('blocked', 'discarded', 'pending', 'approved') SET DEFAULT null
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}

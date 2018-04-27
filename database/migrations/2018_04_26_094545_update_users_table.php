<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('username', 60)->unique()->after('id');
            $table->string('fullname', 100)->after('username');
            $table->string('email', 255)->change()->after('fullname');
            $table->string('avatar')->nullable()->after('email');
            $table->tinyInteger('role')->default(0)->after('avatar');
            $table->string('address')->nullable()->after('password');
            $table->dateTime('birthday')->nullable()->after('address');
            $table->string('job')->nullable()->after('birthday');
            $table->string('gender')->after('job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('username');
            $table->dropColumn('fullname');
            $table->dropColumn('email');
            $table->dropColumn('avatar');
            $table->dropColumn('role');
            $table->dropColumn('address');
            $table->dropColumn('birthday');
            $table->dropColumn('job');
            $table->dropColumn('gender');
        });
    }
}

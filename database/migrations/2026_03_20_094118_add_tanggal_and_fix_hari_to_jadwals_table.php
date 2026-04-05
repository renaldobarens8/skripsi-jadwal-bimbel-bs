<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalAndFixHariToJadwalsTable extends Migration
{
    public function up()
    {
        Schema::table('jadwals', function (Blueprint $table) {
            // Change hari from string to integer
            $table->integer('hari')->nullable()->change();
            // Add tanggal column
            $table->date('tanggal')->nullable()->after('jam');
            // Add user_id if it doesn't exist yet
            if (!Schema::hasColumn('jadwals', 'user_id')) {
                $table->unsignedInteger('user_id')->nullable()->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->string('hari')->nullable()->change();
            $table->dropColumn('tanggal');
        });
    }
}
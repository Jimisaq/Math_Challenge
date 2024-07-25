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
    public function up()
    {
        Schema::table('challengeattempt', function (Blueprint $table) {
            Schema::table('challengeattempt', function (Blueprint $table) {
                $table->dateTime('end_time')->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challengeattempt', function (Blueprint $table) {
            //
        });
    }
};

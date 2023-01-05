<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsWinColumnToHblMemberPredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hbl_member_prediction_teams', function (Blueprint $table) {
            $table->boolean('is_win')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hbl_member_prediction_teams', function (Blueprint $table) {
            $table->dropColumn('is_win');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHblMemberPredictionTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hbl_member_prediction_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hbl_member_id')->constrained()->onDelete('cascade');
            $table->foreignId('hbl_team_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hbl_member_prediction_teams');
    }
}

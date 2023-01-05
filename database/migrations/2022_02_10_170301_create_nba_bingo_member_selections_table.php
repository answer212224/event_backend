<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbaBingoMemberSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nba_bingo_member_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nba_bingo_member_id')->constrained()->onDelete('cascade');
            $table->foreignId('nba_bingo_question_id')->constrained()->onDelete('cascade');
            $table->boolean('is_win')->default(0);
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
        Schema::dropIfExists('nba_bingo_member_selections');
    }
}

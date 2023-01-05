<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('election_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('election_member_id')->constrained()->onDelete('cascade');
            $table->foreignId('election_candidate_id')->constrained()->onDelete('cascade');
            $table->string('city');
            $table->ipAddress('ip')->nullable();
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
        Schema::dropIfExists('election_votes');
    }
}

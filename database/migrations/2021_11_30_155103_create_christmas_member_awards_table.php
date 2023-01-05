<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChristmasMemberAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('christmas_member_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('christmas_member_id')->constrained()->onDelete('cascade');
            $table->integer('award_id');
            $table->ipAddress('ip');
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
        Schema::dropIfExists('christmas_member_awards');
    }
}

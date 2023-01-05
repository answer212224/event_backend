<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdAnimalVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd_animal_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bd_animal_member_id')->constrained()->onDelete('cascade');
            $table->foreignId('bd_animal_pet_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('bd_animal_votes');
    }
}

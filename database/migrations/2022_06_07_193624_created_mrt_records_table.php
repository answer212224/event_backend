<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedMrtRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrt_records', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('internal_code')->nullable();
            $table->string('outer_code')->nullable();
            $table->dateTime('recorded_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mrt_records');
    }
}

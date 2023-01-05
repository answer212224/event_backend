<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMrtMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mrt_members', function (Blueprint $table) {
            $table->string('transportation')->nullable();
            $table->string('is_covid')->nullable();
            $table->string('is_lottery')->nullable();
            $table->ipAddress('ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mrt_members', function (Blueprint $table) {
            $table->dropColumn('transportation');
            $table->dropColumn('is_covid');
            $table->dropColumn('is_lottery');
            $table->dropColumn('ip');
        });
    }
}

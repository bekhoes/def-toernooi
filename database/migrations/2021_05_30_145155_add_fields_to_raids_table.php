<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToRaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raids', function (Blueprint $table) {
            $table->unsignedBigInteger('kills')->after('team_id');
            $table->unsignedBigInteger('dogtags')->after('kills');
            $table->unsignedBigInteger('dogtags_teamleader')->after('dogtags');
            $table->unsignedBigInteger('grenade_kills')->after('dogtags_teamleader');
            $table->unsignedBigInteger('intel')->after('grenade_kills');
            $table->unsignedBigInteger('roler')->after('intel');
            $table->unsignedBigInteger('fuel')->after('roler');
            $table->unsignedBigInteger('tt')->after('fuel');
            $table->boolean('reshala')->after('tt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('raids', function (Blueprint $table) {
            //
        });
    }
}

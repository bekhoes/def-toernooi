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
            $table->unsignedBigInteger('labskey')->after('dogtags');
            $table->unsignedBigInteger('gpu')->after('labskey');
            $table->unsignedBigInteger('tetris')->after('gpu');
            $table->unsignedBigInteger('ledx')->after('tetris');
            $table->unsignedBigInteger('moonshine')->after('ledx');
            $table->unsignedBigInteger('waterfilter')->after('moonshine');
            $table->boolean('helmet')->after('waterfilter');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsFromRaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raids', function (Blueprint $table) {
            $table->dropColumn('kills');
            $table->dropColumn('dogtags');
            $table->dropColumn('labskey');
            $table->dropColumn('gpu');
            $table->dropColumn('tetris');
            $table->dropColumn('ledx');
            $table->dropColumn('moonshine');
            $table->dropColumn('waterfilter');
            $table->dropColumn('helmet');
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

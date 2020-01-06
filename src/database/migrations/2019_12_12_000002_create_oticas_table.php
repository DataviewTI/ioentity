<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateOticasTable extends Migration
{

    public function up(){
        Schema::create('oticas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->char('alias',10);
            $table->boolean('main')->default(false);
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('oticas');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

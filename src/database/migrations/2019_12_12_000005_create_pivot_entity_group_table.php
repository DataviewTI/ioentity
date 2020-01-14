<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotEntityGroupTable extends Migration
{
    public function up() {
        Schema::create('entity_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('otica_id')->unsigned();
            $table->date('date');
            $table->decimal('value')->default(0);
            $table->decimal('payment')->default(0);
            $table->string('product')->nullable();
            $table->binary('details')->nullable();
            $table->enum('status', ['Normal', 'Inativo', 'Bloqueado','De Risco','Avalisado'])->default('Normal');
            $table->timestamps();
            $table->foreign('otica_id')->references('id')->on('oticas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    public function down(){
      Schema::dropIfExists('entity_group');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntityTable extends Migration
{
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {

            $table->increments('id');
            $table->char('cpf_cnpj', 14)->unique(); 
            $table->char('cod_cliente', 14)->unique(); 
            $table->integer('otica_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
            $table->enum('status', ['Ativo', 'Inativo', 'Bloqueado'])->default('Ativo');
            $table->string('nome');
            $table->char('rg', 50)->nullable();
            $table->enum('sexo', ['M', 'F', 'I'])->default('F');
            $table->enum('estado_civil', ['Casado', 'Separado', 'Divorciado', 'Solteiro', 'Viúvo'])->nullable();
            $table->string('profissao')->nullable();
            $table->string('local_trabalho')->nullable();
            $table->date('dt_nascimento')->nullable();
            $table->char('telefone1', 15)->nullable();
            $table->char('telefone2', 15)->nullable();
            $table->char('celular1', 15)->nullable();
            $table->char('celular2', 15)->nullable();
            $table->string('email')->nullable();
            $table->char('zipCode', 9)->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->text('refs_pessoais')->nullable();
            $table->text('refs_comerciais')->nullable();
            $table->char('city_id',7);
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('otica_id')->references('id')->on('oticas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->text('observacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
      Schema::dropIfExists('entities');
    }
}

<?php
namespace Dataview\IOEntity;

use Dataview\IntranetOne\IOModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends IOModel
{
    use SoftDeletes;
    protected $primaryKey = 'id';

    protected $fillable = ['cpf_cnpj', 'tipo', 'razaosocial', 'nome_fantasia', 'insc_estadual', 'responsavel', 'rg', 'sexo', 'estado_civil', 'nacionalidade', 'profissao', 'dt_nascimento', 'telefone1', 'telefone2', 'celular1', 'celular2', 'email', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade_id', 'observacao']; //campos que podem ser editados

    protected $dates = ['deleted_at'];

    public function city(){
      return $this->belongsTo('City');
    }

    public static function boot(){
        parent::boot();
    }
}

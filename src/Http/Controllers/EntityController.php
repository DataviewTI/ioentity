<?php
namespace Dataview\IOEntity;

use DataTables;
use Dataview\IntranetOne\IOController;
use Dataview\IOEntity\Entity;
use Dataview\IOEntity\EntityRequest;
use Illuminate\Http\Response;

class EntityController extends IOController
{

  public function __construct(){
    $this->service = 'entity';
  }

  public function index(){
    return view('Entity::index');
  }

  function list() {
    $query = Entity::select('*')->orderBy('created_at', 'desc')->get();
    return Datatables::of(collect($query))->make(true);
  }

  public function create(EntityRequest $request){
    $check = $this->__create($request);
    
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }
    
    $obj = new Entity($request->all());
    $obj->save();

    return response()->json(['success' => true, 'data' => null]);
  }

  public function view($id)
  {
    $check = $this->__view();
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }

    $query = Entity::select('entidades.*', 'cidades.cidade', 'cidades.uf')
        ->join('cidades', 'entidades.cidade_id', '=', 'cidades.id')
        ->where('entidades.id', $id)->get();

    return response()->json(['success' => true, 'data' => $query]);
  }

  public function update($id, EntityRequest $request){
    $check = $this->__update($request);
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }

    $_new = (object) $request->all();

    $_old = Entity::find($id);
    $_old->tipo = $_new->tipo;
    $_old->razaosocial = $_new->razaosocial;
    $_old->nome_fantasia = $_new->nome_fantasia;
    $_old->insc_estadual = $_new->insc_estadual;
    $_old->responsavel = $_new->responsavel;
    $_old->rg = $_new->rg;
    $_old->sexo = $_new->sexo;
    $_old->estado_civil = $_new->estado_civil;
    $_old->nacionalidade = $_new->nacionalidade;
    $_old->profissao = $_new->profissao;
    $_old->dt_nascimento = $_new->dt_nascimento;
    $_old->telefone1 = $_new->telefone1;
    $_old->telefone2 = $_new->telefone2;
    $_old->celular1 = $_new->celular1;
    $_old->celular2 = $_new->celular2;
    $_old->email = $_new->email;
    $_old->cep = $_new->cep;
    $_old->logradouro = $_new->logradouro;
    $_old->numero = $_new->numero;
    $_old->complemento = $_new->complemento;
    $_old->bairro = $_new->bairro;
    $_old->cidade_id = $_new->cidade_id;
    $_old->observacao = $_new->observacao;

    $_old->save();
    return response()->json(['success' => $_old->save()]);
  }

  public function delete($id){
    $check = $this->__delete();
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }

    $obj = Entity::find($id);
    $obj = $obj->delete();
    return json_encode(['sts' => $obj]);
  }

  public function checkId($id){
    return Entity::select('razaosocial')->where('id', '=', $id)->get();
  }

  public function getCep($cep){
  }

  public function cidadesMigration(){
    $json = File::get("js/data/cidades.json");
    $data = json_decode($json, true);
    $r = "";
    foreach ($data as $obj)
      $r .= $obj['id'];
    return $r;
  }

  public function getEntidades($query){
    return json_encode(Entity::select('razaosocial as n', 'cpf_cnpj as k')->where('razaosocial', 'like', "%$query")->get());
  }

  public function get_enum_values( $table, $field ){
    $type = Entity::query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
  }
}

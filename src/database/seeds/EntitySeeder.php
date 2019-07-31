<?php
namespace Dataview\IOEntity;

use Dataview\IntranetOne\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Sentinel;

class EntitySeeder extends Seeder
{
  public function run()
  {
    //cria o serviço se ele não existe
    if (!Service::where('service', 'Entity')->exists()) {
        Service::insert([
            'service' => "Entity",
            'alias' => 'entity',
            'ico' => 'ico-book-users',
            'description' => 'Entidades do Sistema (Cliente, Funcionário e Fornecedor)',
            'order' => Service::max('order') + 1,
        ]);
    }
      //seta privilegios padrão para o role admin
      $adminRole = Sentinel::findRoleBySlug('admin');
      $adminRole->addPermission('entity.view');
      $adminRole->addPermission('entity.create');
      $adminRole->addPermission('entity.update');
      $adminRole->addPermission('entity.delete');
      $adminRole->save();
      /*
      Cidade::query()->truncate();
      $json = File::get("public/io/services/cidades.json");
      $data = json_decode($json, true);
      $i = 0;
      foreach ($data as $obj) {
          Cidade::create(
              array(
                  'id' => $obj['id'],
                  'cidade' => $obj['cidade'],
                  'uf' => $obj['uf'],
              )
          );
      }
      */
  }
}

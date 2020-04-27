<?php
namespace Dataview\IOEntity;

use Dataview\IntranetOne\IntranetOneServiceProvider;
use Dataview\IntranetOne\Category;
use Dataview\IntranetOne\City;
use Dataview\IntranetOne\Service;
use Dataview\IOEntity\Models\Otica;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Dataview\IOEntity\IOEntityServiceProvider;
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
            'trans' => 'Clientes',
            'ico' => 'ico-book-users',
            'description' => 'Relação de Clientes',
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
      

      \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      \DB::table('cities')->truncate();
      \DB::table('oticas')->truncate();
      \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      $oticas = [
        ["name"=>"Ótica Baroni", "alias"=> "Baroni", "main" => false],
        ["name"=>"Ótica Ceres", "alias"=> "Ceres", "main" => false],
        ["name"=>"Ótica Globo", "alias"=>"Globo", "main" => false],
        ["name"=>"Ótica Gurupi", "alias"=>"Gurupi", "main" => false],
        ["name"=>"Rio Ótica", "alias"=>"Rio Ótica","main" => true],
        ["name"=>"Ótica Vênus", "alias"=>"Vênus", "main" => false],
        ["name"=>"Ótica Visão", "alias"=>"Visão", "main" => false],
      ];

      foreach($oticas as $o){
         Otica::create([
            'name' => $o["name"],
            'alias' => $o["alias"],
            'main' => $o["main"],
          ]);
      }
      
      if(empty(\DB::table('cities')->select('id')->first())){
        $json = File::get(IntranetOneServiceProvider::pkgAddr('/assets/src/base/js/data/cities.json'));
        $data = json_decode($json, true);
        foreach ($data as $obj) {
            City::create([
              'id' => $obj['i'],
              'city' => $obj['c'],
              'region' => $obj['u'],
            ]);
        }
      }

  }
}

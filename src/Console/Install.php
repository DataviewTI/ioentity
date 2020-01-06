<?php
namespace Dataview\IOEntity\Console;
use Dataview\IntranetOne\Console\IOServiceInstallCmd;
use Dataview\IOEntity\IOEntityServiceProvider;
use Dataview\IOEntity\EntitySeeder;

class Install extends IOServiceInstallCmd
{
  public function __construct(){
    parent::__construct([
      "service"=>"entity",
      "provider"=> IOEntityServiceProvider::class,
      "seeder"=>EntitySeeder::class,
    ]);
  }

  public function handle(){
    parent::handle();
  }
}

<?php
namespace Dataview\IOEntity\Console;

use Dataview\IntranetOne\Console\IOServiceRemoveCmd;
use Dataview\IntranetOne\IntranetOne;
use Dataview\IOEntity\IOEntityServiceProvider;


class Remove extends IOServiceRemoveCmd
{
  public function __construct(){
    parent::__construct([
      "service"=>"entity",
      "tables" =>['entidade'],
    ]);
  }

  public function handle(){
    parent::handle();
  }
}

<?php

namespace Dataview\IOEntity;

use Illuminate\Support\ServiceProvider;

class IOEntityServiceProvider extends ServiceProvider
{
  public static function pkgAddr($addr){
    return __DIR__.'/'.$addr;
  }

  public function boot(){
    $this->loadViewsFrom(__DIR__.'/views', 'Entity');
  }

  public function register(){
  $this->commands([
    Console\Install::class,
    Console\Remove::class
  ]);

  $this->app['router']->group(['namespace' => 'dataview\ioentity'], function () {
    include __DIR__.'/routes/web.php';
  });
  
    $this->app->make('Dataview\IOEntity\EntityController');
    $this->app->make('Dataview\IOEntity\EntityRequest');
    $this->app->make('Dataview\IOEntity\EntityHistoryRequest');
  }
}

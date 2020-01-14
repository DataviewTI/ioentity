<?php
/*
  funções declaradas dentro do web.php geram erro no artisan config:cache, mensagem de declaração duplicada
  sem existir, por isso foi usado o helper;
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web','admin'], 'as' => 'admin.'],function(){
    Route::group(['prefix' => 'entity'], function () {
    Route::get('/','EntityController@index');
    // Route::get('teste', 'EntityController@teste');
    Route::get('list', 'EntityController@list');
    Route::get('history/list/{id?}', 'EntityController@historyList');
    Route::get('view/{id}', 'EntityController@view');
    Route::post('create', 'EntityController@create');
    Route::post('history/create', 'EntityController@historyCreate');
    Route::post('update/{id}', 'EntityController@update');
    Route::post('history/update/{id}', 'EntityController@update');
    Route::get('history/delete/{eid}/{gid}', 'EntityController@deleteHist');
    Route::get('delete/{id}', 'EntityController@delete');			
  });
});

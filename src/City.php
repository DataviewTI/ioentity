<?php

namespace Dataview\IOEntity;

use Dataview\IntranetOne\IOModel;

class City extends IOModel
{
	protected $fillable = ['id','cidade','uf'];
	protected $dates = ['deleted_at'];
	
	public function entities(){
		return $this->hasMany('Entity');
	}
}

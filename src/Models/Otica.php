<?php

namespace Dataview\IOEntity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Otica extends Model
{
  protected $fillable = ['id','name','alias','main'];

  
  public function entities(){
		return $this->hasMany('Dataview\IOEntity\Entity');
	}}

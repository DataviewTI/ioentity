<?php

namespace Dataview\IOEntity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class City extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','city','state'];
  	protected $dates = ['deleted_at'];

    public function entities(){
      return $this->hasMany('Entity');
    }    
}

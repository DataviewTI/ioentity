<?php
namespace Dataview\IOEntity;

use Dataview\IntranetOne\IOModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityHistory extends IOModel
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = "entity_history";

    protected $fillable = [
        'entity_id',
        'group_id',
        'date',
        'observacoes',
        'valor'
      ];

    protected $dates = ['deleted_at'];

    public function group(){
      return $this->belongsTo('Dataview\IntranetOne\Group');
    }
    
  public static function boot(){ 
    parent::boot(); 

    static::created(function (Popup $obj) {
      if($obj->getAppend("hasImages")){
        $group = new Group([
          'group' => "Entity History ".$obj->id,
          'sizes' => $obj->getAppend("sizes")
        ]);
        $group->save();
        $obj->group()->associate($group)->save();
      }
    });
  }
}

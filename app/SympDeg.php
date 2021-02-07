<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SympDeg extends Model
{
    protected $table='symp_degs';
    protected $fillable = [
        'symp_deg', 'title',
    ];
    public $timestamps=false;
    protected $fillable_relations = ['sympconts','sympdegs'];

    public  function sympcnt(){
        return $this->hasMany(Sympcont::class , 'symp_id');
    }

    public  function symp(){
        return $this->hasMany(Symp::class , 'symp_id');
    }
}

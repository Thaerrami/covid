<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symp extends Model
{
    protected $table='symps';
    protected $fillable = [
        'symp_id','Patient_id','date','dayreport'
    ];
    
    public $timestamps = false;
    public  function symp(){
        return $this->belongsTo(SympDeg::class , 'symp_id');
    }

    public  function patient(){
        return $this->belongsTo(User::class , 'Patient_id','id');
    }
}

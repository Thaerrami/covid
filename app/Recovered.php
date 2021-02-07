<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recovered extends Model
{
    protected $table='recovereds';
    protected $fillable=['date','Patient_id','recoverreport'];
    public $timestamps = false;
    
    public function Patient(){
        return $this->belongsTo(User::class,'Patient_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patreport extends Model
{
    protected $table='patreports';
    protected $fillable=['report','Patient_id'];
    public $timestamps=false;

    public function Patient(){
        return $this->belongsTo(User::class,'Patient_id','id');
    }

    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    protected $table='deaths';
    protected $fillable=['date','id','Patient_id'];
    public $timestamps = false;
    
    public function Patient(){
        return $this->belongsTo(User::class,'Patient_id','id');
    }
     
}

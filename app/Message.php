<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';
    protected $fillable=['Patient_id','Doc_id','sender','message'];
    
    public function Patient(){
        return $this->belongsToMany(User::class,'Patient_id','id');
    }

    public function Doc(){
        return $this->belongsToMany(Doc::class,'Doc_id','id');
    }
}

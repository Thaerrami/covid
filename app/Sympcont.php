<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sympcont extends Model
{
    protected $fillable = [
        'symp_id', 'sympcont',
    ];

    public  function sympdeg(){
        return $this->belongsTo(SympDeg::class , 'symp_id');
    }
}

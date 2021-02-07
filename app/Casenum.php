<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casenum extends Model
{
    protected $table='casenums';
    protected $fillable = ['daycase','norcase','midcase','dancase','death','recover','date'];
    public $timestamps=false;   
}

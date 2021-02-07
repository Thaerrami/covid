<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','image','country','city','docid','birthdate'
    ];  
    protected $fillable_relations = ['symps','patreports','messages','recovereds'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function symp(){
        return $this->hasMany(Symp::class,'Patient_id');
    }

    public function Death(){
        return $this->hasMany(Death::class,'Patient_id','id');
    }

    public function Recover(){
        return $this->hasMany(Recovered::class,'Patient_id','id');
    }

    public function Patreport(){
        return $this->hasMany(Patreport::class,'Patient_id','id');
    }

    public function Doc(){
        return $this->belongsTo(Doc::class,'docid','id');
    }


    public function Message(){
        return $this->hasMany(Message::class,'Patient_id','id');
    }

}

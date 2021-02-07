<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doc extends Authenticatable
{
    use Notifiable;

    protected $guard = 'doc';

    protected $fillable = [
        'name', 'email', 'password','image','phone','title','numofpat','country','city','startwork','endwork','description'
    ];

    protected $fillable_relations = ['users','messages'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Patient(){
        return $this->hasMany(User::class,'docid','id');
    }

    public function Message(){
        return $this->hasMany(Message::class,'Doc_id','id');
    }

}
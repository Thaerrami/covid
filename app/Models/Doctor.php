<?php


namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Doctor extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'doctor';

        protected $table='doctors';

        protected $fillable = [
            'name', 'email', 'password','phone'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use App\Notifications\ResetPassword as ResetPasswordNotification; 
use Illuminate\Auth\Passwords\CanResetPassword; 

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use CanResetPassword; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tel','qq','wx','sex','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function sendPasswordResetNotification($token) 
    { 
     $this->notify(new ResetPasswordNotification($token)); 
    }
}

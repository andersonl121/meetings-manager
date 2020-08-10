<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\createUser;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */

    protected $fillable = [
        'name', 'email', 'password','isGestor','type','login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function docs(){
        return $this->belongsToMany('App\Doc','UsersDocs','Docs_id','Users_id')->withPivot('dateTime','type');
    }

    public function meetings(){
        return $this->hasMany('App\Meeting','Users_id');
    }

    
}

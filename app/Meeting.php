<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{

    protected $fillable=['dsc','date','type'];

    protected $hidden=['id'];

    public function docs(){
        return $this->hasMany('App\Doc','Meetings_id');
    }

    public function user(){
        return $this->belongsTo('App\User','Users_id');
    }

    

}

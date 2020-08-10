<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{

    protected $fillable=['dsc','type','Meetings_id'];

    protected $hidden=['id'];

    public function users(){
        return $this->belongsToMany('App\User','UsersDocs','Users_id','Docs_id')->withPivot('dateTime','type');
    }

    public function meeting(){
        return $this->hasOne('App\Meeting','Meetings_id');
    }
}
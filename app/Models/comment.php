<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comment';


    public function post(){
    	return $this->belongsTo('App\Models\post', 'post_id','id');
    }
    public function user(){
    	return $this->hasMany('app\Models\User', 'user_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = 'post';
    public function category(){
    	return $this->belongsTo('App\Models\category', 'category_id','id');
    }
    public function comment(){
    	return $this->hasMany('app\Models\comment', 'comment_id','id');
    }

}

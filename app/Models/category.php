<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'category';

    public function post(){
    	return $this->hasMany('app\Models\post', 'category_id','id');
    }
}

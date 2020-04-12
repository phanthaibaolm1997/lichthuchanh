<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocky extends Model
{
    protected $table = "hocky";
    public $primaryKey = "hocky";

    //Quan hệ
    public function lophocphan(){
		return $this->hasMany('App\lophocphan', 'hocky');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class namhoc extends Model
{
    protected $table = "namhoc";
    public $primaryKey = "namhoc";

    //Quan hệ
    public function lophocphan(){
		return $this->hasMany('App\lophocphan', 'namhoc');
	}
}

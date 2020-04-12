<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocphan extends Model
{
    protected $table = "hocphan";
    public $primaryKey = "hp_id";

    //Quan hệ
    public function lophocphan(){
		return $this->hasMany('App\lophocphan', 'hp_id');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class canbo extends Model
{
    protected $table = "canbo";
    public $primaryKey = "cb_id";

    // Quan hệ
	public function quyen(){
		return $this->belongsTo('App\quyen', 'q_ma');
	}
	public function lophocphan(){
		return $this->hasMany('App\lophocphan', 'cb_id');
	}

}

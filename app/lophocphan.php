<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lophocphan extends Model
{
    protected $table = "lophocphan";
    public $primaryKey = "sttl";

    // Relationship
	public function hocky(){
		 return $this->belongsTo('App\hocky', 'hocky');
	}
	public function canbo(){
		 return $this->belongsTo('App\canbo', 'cb_id');
	}
	public function hocphan(){
		 return $this->belongsTo('App\hocphan', 'hp_id');
	}
	public function namhoc(){
		 return $this->belongsTo('App\namhoc', 'namhoc');
	}
	public function nhomthuchanh(){
		return $this->hasMany('App\nhomthuchanh', 'sttl');
	}
}

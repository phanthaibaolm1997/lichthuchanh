<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lophocphan extends Model
{
    protected $table = "lophocphan";
    public $primaryKey = ["sttl","hocky","hp_id","namhoc"];

    // Relationship
	public function hocky(){
		 return $this->belongsTo('App\hocky', 'hocky');
	}
	public function hocphan(){
		 return $this->belongsTo('App\hocphan', 'hp_id');
	}
	public function namhoc(){
		 return $this->belongsTo('App\namhoc', 'namhoc');
	}
}

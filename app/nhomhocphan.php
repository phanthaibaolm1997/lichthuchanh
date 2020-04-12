<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhomhocphan extends Model
{
    protected $table = "nhomhocphan";
    public $primaryKey = "stt_nhom";

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
	public function lophocphan(){
		 return $this->belongsTo('App\lophocphan', 'sttl');
	}

}

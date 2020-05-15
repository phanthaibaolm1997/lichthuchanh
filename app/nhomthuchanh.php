<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhomthuchanh extends Model
{
    protected $table = "nhomthuchanh";
    public $primaryKey = "sttnhom";

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
		 return $this->belongsTo('App\lophocphan', 'sttl')->with('canbo');
	}
	public function tkb(){
		return $this->hasMany('App\tkb', 'sttnhom');
	}

	public function getAllNhom(){
		return nhomthuchanh::with('hocky')
			->with('hocphan')
			->with('namhoc')
			->with('lophocphan')
			->get();
	}

}
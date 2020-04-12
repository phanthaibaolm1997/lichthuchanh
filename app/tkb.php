<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tkb extends Model
{
    protected $table = "tkb";
    public $primaryKey = ["stt_nhom","thu","buoi","tuan",'stt_phong'];

    // Relationship
	public function thu(){
		 return $this->belongsTo('App\thu', 'thu');
	}
	public function tuan(){
		 return $this->belongsTo('App\tuan', 'tuan');
	}
	public function buoi(){
		 return $this->belongsTo('App\buoi', 'buoi');
	}
	public function phong(){
		 return $this->belongsTo('App\phong', 'stt_phong');
	}
	public function trangthai(){
		 return $this->belongsTo('App\trangthai', 'tt_id');
	}
}

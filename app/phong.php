<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phong extends Model
{
    protected $table = "phong";
    public $primaryKey = "phong_stt";
    
   // Quan hệ
    public function phanmem(){
		 return $this->belongsTo('App\phanmem', 'pm_id');
	}
	public function version_software(){
		 return $this->belongsTo('App\version_software', 'ver_ma');
	}
	public function tkb(){
		return $this->hasMany('App\tkb', 'phong_stt');
	}
}

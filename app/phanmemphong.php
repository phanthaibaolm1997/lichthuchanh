<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phanmemphong extends Model
{
    protected $table = "phanmemphong";
    public $timestamps = false;

    // Quan hệ
	public function phanmem(){
		 return $this->belongsTo('App\phanmem', 'pm_id')->with('version_software');
	}
	public function phong(){
		 return $this->belongsTo('App\phong', 'phong_stt');
	}

	//truy vanas
	public function create($phong_stt,$ver_ma,$pm_id){
		$create = new phanmemphong();
		$create->phong_stt = $phong_stt;
		$create->ver_ma = $ver_ma;
		$create->pm_id = $pm_id;
		$create->save();
	}

	public function deletePMP($phong, $version, $phanmem){
		phanmemphong::where([
			'phong_stt'=>$phong,
			'ver_ma'=>$version,
			'pm_id'=>$phanmem
		])->delete();
	}
}

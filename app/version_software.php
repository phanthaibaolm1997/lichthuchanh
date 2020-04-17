<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class version_software extends Model
{
    protected $table = "version_software";
    public $primaryKey = "ver_ma";
    public $timestamps = false;
    
    // Quan hệ
	// public function phanmem(){
	// 	 return $this->hasMany('App\phanmem', 'pm_id');
	// }
	public function phanmem(){
		 return $this->belongsTo('App\phanmem', 'pm_id');
	}

	public function getAllVersion(){
		return version_software::with('phanmem')->get();
	}

	public function createVersion($pm_id, $ver_ma, $version){
		$version_software = new version_software();
		$version_software->ver_ma = $ver_ma;
		$version_software->pm_id = $pm_id;
		$version_software->version = $version;
		$version_software->save();
	}

	public function delPhanMemVersion($id,$ver){
		version_software::where([
			'pm_id'=>$id,
			'ver_ma'=>$ver
		])->delete();
	}

	public function ajaxGetVersion($id){
		return version_software::where('pm_id',$id)->get();
	}
}

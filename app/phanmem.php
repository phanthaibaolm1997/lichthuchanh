<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phanmem extends Model
{
    protected $table = "phanmem";
    public $primaryKey = "pm_id";
    public $timestamps = false;
    
    // Quan hệ
	// public function version_software(){
	// 	 return $this->belongsTo('App\version_software', 'pm_id');
	// }
	public function version_software(){
		 return $this->hasMany('App\version_software', 'pm_id');
	}

	public function yeucau(){
		return $this->hasMany('App\yeucau', 'pm_id');
	}

	public function getAllPM(){
		return phanmem::with('version_software')->get();
	}

	public function createPM($name){
		$phanmem = new phanmem();
		$phanmem->pm_ten = $name;
		$phanmem->save();
	}

	public function editPM($name,$id){
		phanmem::where('pm_id',$id)
			->update([
				'pm_ten'=>$name
			]);
	}

	public function delPhanMem($id){
		phanmem::where('pm_id',$id)
			->delete();
	}

	public function thongkePMYC(){
        $data = phanmem::with('yeucau')->get();
        return $data;
    }

    public function allPMAuto(){
        return phanmem::pluck('pm_id')->toArray();
    }
}

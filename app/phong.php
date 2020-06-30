<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phong extends Model
{
    protected $table = "phong";
    public $primaryKey = "phong_stt";
    public $timestamps = false;
    
   // Quan hệ
    public function phanmemphong(){
		 return $this->hasMany('App\phanmemphong', 'phong_stt')->with('phanmem');
	}

	public function tkb(){
		return $this->hasMany('App\tkb', 'phong_stt');
	}

	//Data
	public function getAllPhong(){
		return phong::all();
	}

	public function createPhong($name, $soluong){
		$phong  = new phong();
		$phong->phong_ten = $name;
		$phong->phong_slmay = $soluong;
		$phong->save();
	}
	public function editPhong($name, $soluong, $id){
		phong::where('phong_stt',$id)
			->update([
				'phong_ten'=>$name,
				'phong_slmay'=>$soluong
			]);
	}

	public function getDetail($id){
		$data = phong::with('phanmemphong')->where('phong_stt',$id)->first();
		return $data;
	}

	public function filterPhong($pm,$sl){
		$data = phong::where('phong_slmay','>=',$sl)->with('phanmemphong')->get();
		$dataF = [];
		foreach ($data as $o) {
			$check = false;
			if(count($o->phanmemphong) > 0){
				$arr = $o->phanmemphong;
				foreach ($arr as $a) {
					if ($a->pm_id == $pm) {
						$check = true;
					}
				}
			}
			if($check){
				array_push($dataF, $o);
			}
		}
    	return $dataF;
	}

	public function getComputerofRoom(){
		$room = phong::select(['phong_stt','phong_slmay'])
			->get()->toArray();
		return $room;
	}

	public function getPMYCRoom(){
		$data =  phong::with('phanmemphong')->get();
		$arrTemp = [];
		foreach ($data as $d) {
			$arrPM = [];
			foreach ($d->phanmemphong as $pm ){
				array_push($arrPM,$pm->pm_id);
			}
			$hihi = [$d->phong_stt,$arrPM,$d->phong_slmay];
			array_push($arrTemp,$hihi);
		}
		return $arrTemp;
	}

	public function thongkeSLPMPhong(){
		$data = phong::with('phanmemphong')->get();
		
		return $data;
	}
}

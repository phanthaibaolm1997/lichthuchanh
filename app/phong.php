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

	public function getComputerofRoom(){
		$room = phong::select(['phong_stt','phong_slmay'])
			->get()->toArray();
		return $room;
	}
}

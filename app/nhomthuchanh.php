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
	public function yeucau(){
		return $this->hasMany('App\yeucau', 'sttnhom');
	}

	public function getAllNhom(){
		return nhomthuchanh::with('hocky')
			->with('hocphan')
			->with('namhoc')
			->with('lophocphan')
			->get();
	}

	public function allPracticeGroup($schoolYear,$semester){
		$data =  nhomthuchanh::where(
			[
				'namhoc'=>$schoolYear,
				'hocky'=>$semester
			])
			->with('hocky')
			->with('hocphan')
			->with('namhoc')
			->with('lophocphan')
			->get();
		return $data;

	}

	public function updateThucHanh($cb_id,$hp_id,$namhoc,$hocky,$sttl){
		$create = new  nhomthuchanh();
		$create->hp_id = $hp_id;
		$create->namhoc = $namhoc;
		$create->hocky = $hocky;
		$create->sttl = $sttl;
		$create->save();
		return $create;
	}

	public function updateStatus($stt,$status){
		nhomthuchanh::where('sttnhom',$stt)
			->update([
				'is_practice'=>$status
			]);
	}

	public function getSiSo($stt){
		return nhomthuchanh::select('nth_siso')
		->where('sttnhom',$stt)
		->first();
	}

	public function updateStatusDemo($schoolYear,$semester){
		$data =  nhomthuchanh::where(
			[
				'namhoc'=>$schoolYear,
				'hocky'=>$semester
			])->update(['is_practice'=>0]);
	}


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lophocphan extends Model
{
    protected $table = "lophocphan";
    public $primaryKey = "sttl";

    // Relationship
	public function hocky(){
		 return $this->belongsTo('App\hocky', 'hocky');
	}
	public function canbo(){
		 return $this->belongsTo('App\canbo', 'cb_id');
	}
	public function hocphan(){
		 return $this->belongsTo('App\hocphan', 'hp_id');
	}
	public function namhoc(){
		 return $this->belongsTo('App\namhoc', 'namhoc');
	}
	public function nhomthuchanh(){
		return $this->hasMany('App\nhomthuchanh', 'sttl')->with('yeucau');
	}

	public function createLHP($cb_id,$ten_lhp,$soluong_lhp,$hp_id,$thisSchoolYear,$semester){
		$stt = lophocphan::max('sttl');
		$lophocphan = new lophocphan();
		$lophocphan->cb_id = $cb_id;
		$lophocphan->lhp_ten = $ten_lhp;
		$lophocphan->lhp_soluongdk = $soluong_lhp;
		$lophocphan->hp_id = $hp_id;
		$lophocphan->namhoc = $thisSchoolYear;
		$lophocphan->hocky = $semester;
		$lophocphan->sttl = $stt+1;
		$lophocphan->save();
		return true;
	}

	public function eidtLHP($cb_id,$lhp_ten,$lhp_soluongdk,$hp_id,$namhoc,$hocky,$sttl){
		$edit = lophocphan::where([
			'hp_id' => $hp_id,
			'cb_id' => $cb_id,
			'namhoc' => $namhoc,
			'hocky' => $hocky,
			'sttl' => $sttl,
		])->update([
				'lhp_ten' => $lhp_ten,
				'lhp_soluongdk' => $lhp_soluongdk
			]);
		if ($edit) {
			return true;
		}
		return false;
	}
	public function deleteLHP($cb_id,$hp_id,$namhoc,$hocky,$sttl){
		$delete = lophocphan::where([
			'hp_id' => $hp_id,
			'cb_id' => $cb_id,
			'namhoc' => $namhoc,
			'hocky' => $hocky,
			'sttl' => $sttl,
		])->delete();

		if ($delete) {
			return true;
		}
		return false;
	}

	public function getAllLHPCB($cb_id,$hocky,$namhoc){
		return lophocphan::where([
			'cb_id' => $cb_id,
			'namhoc' => $namhoc,
			'hocky' => $hocky,
		])->with('hocphan')->with('nhomthuchanh')->get();
	}
}

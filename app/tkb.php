<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class tkb extends Model
{
    protected $table = "tkb";
    public $timestamps = false;
    // public $primaryKey = ["sttnhom","thu","buoi","tuan",'stt_phong'];
    // protected $fillable = ["sttnhom","thu","buoi","tuan",'stt_phong'];

    // Relationship
	public function thu(){
		 return $this->belongsTo('App\thu', 'thu','thu');
	}
	public function tuan(){
		 return $this->belongsTo('App\tuan', 'tuan','tuan');
	}
	public function buoi(){
		 return $this->belongsTo('App\buoi', 'buoi','buoi');
	}
	public function phong(){
		 return $this->belongsTo('App\phong', 'stt_phong','stt_phong');
	}
	public function trangthai(){
		 return $this->belongsTo('App\trangthai', 'tt_id','tt_id');
	}
	public function nhomthuchanh(){
		 return $this->belongsTo('App\nhomthuchanh', 'sttnhom')->with(['hocphan','lophocphan']);
	}


	//Data
	public function getTKBHK($namhoc, $hocky){
		$data = tkb::with(['nhomthuchanh'=> function($q) use($namhoc,$hocky){
				    [$q->where('namhoc', $namhoc),$q->where('hocky', $hocky)];
				}])
			->get();
		return $data;
	}

	public function calendarOfWeek($namhoc, $hocky, $week){
		$data = tkb::where('tuan',$week)
			->with(['nhomthuchanh'=> function($q) use($namhoc,$hocky){
				    [$q->where('namhoc', $namhoc),$q->where('hocky', $hocky)];
				}])
			->get();
		return $data;
	}

	public function createTKB($thu,$buoi,$tuan,$phong,$nhom){
		$create = new tkb();
		$create->buoi = $buoi;
		$create->thu = $thu;
		$create->tuan = $tuan;
		$create->sttnhom = $nhom;
		$create->phong_stt = $phong;
		$create->tt_id = 1;
		$create->save();
	}

	public function updateMessengerTKB($thu,$buoi,$tuan,$phong,$notify){
		tkb::where([
			'thu'=>$thu,
			'buoi'=>$buoi,
			'tuan'=>$tuan,
			'phong_stt'=>$phong
		])->update(['tkb_ghichu'=>$notify]);
	}

	public function deleteTKB($thu,$buoi,$tuan,$phong){
		tkb::where([
			'thu'=>$thu,
			'buoi'=>$buoi,
			'tuan'=>$tuan,
			'phong_stt'=>$phong
		])->delete();
	}

	public function updateNhom($thu,$buoi,$tuan,$phong,$nhom){
		tkb::where([
			'thu'=>$thu,
			'buoi'=>$buoi,
			'tuan'=>$tuan,
			'sttnhom'=>$nhom
		])->update(['phong_stt'=>$phong]);
	}
}

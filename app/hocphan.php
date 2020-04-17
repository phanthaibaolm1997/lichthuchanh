<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocphan extends Model
{
    protected $table = "hocphan";
    public $primaryKey = "hp_id";
    public $incrementing = false;

    //Quan hệ
    public function lophocphan(){
		return $this->hasMany('App\lophocphan', 'hp_id')->with("canbo");
	}
	public function nhomthuchanh(){
		return $this->hasMany('App\nhomthuchanh', 'hp_id');
	}

	public function getHocPhanByCB($cb_id,$hk,$nam){
		$data = hocphan::with(['nhomthuchanh'=> function($q) use($cb_id,$hk,$nam){
				    [
				    	$q->where('namhoc', $nam),
				    	$q->where('hocky', $hk),
				    	
				    ];
				}])
		// ->where('cb_id',$cb_id)
		->get();
		return $data;
	}

	public function getAllHP($paginate){
		$data = hocphan::with('nhomthuchanh')
			->with('lophocphan')
			->paginate($paginate);
		return $data;
	}
}

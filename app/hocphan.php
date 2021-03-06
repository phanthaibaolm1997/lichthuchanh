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
		$data = hocphan::with(['nhomthuchanh'=> function($q) use($hk,$nam){
				    [
				    	$q->where('namhoc', $nam),
				    	$q->where('hocky', $hk),
				    	
				    ];
				}])
		->with(['lophocphan'=> function($q) use($cb_id){
		    [
		    	$q->where('cb_id', $cb_id)
		    ];
		}])
		->get();
		return $data;
	}

	public function getAllHP($paginate){
		$data = hocphan::with('nhomthuchanh')
			->with('lophocphan')
			->paginate($paginate);
		return $data;
	}

	public function createHP($hp_id, $hp_ten){
		$create = new hocphan();
		$create->hp_id = $hp_id;
		$create->hp_ten = $hp_ten;
		$create->save();

		if ($create) {
			return true;
		}
		return false;
	}

	public function editHP($hp_id, $hp_ten){
		$edit = hocphan::where('hp_id',$hp_id)
			->update([
				'hp_ten' => $hp_ten
			]);
		if ($edit) {
			return true;
		}
		return false;
	}

	public function deleteHP($id){
		$delete = hocphan::where('hp_id',$id)->delete();
		if ($delete) {
			return true;
		}
		return false;
	}
}

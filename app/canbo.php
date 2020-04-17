<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class canbo extends Authenticatable 
{
    protected $table = "canbo";
    public $primaryKey = "cb_id";
    protected $fillable = ['email', 'password'];
    public $timestamps = false;

    // Quan hệ
	public function quyen(){
		return $this->belongsTo('App\quyen', 'q_ma');
	}
	public function lophocphan(){
		return $this->hasMany('App\lophocphan', 'cb_id');
	}

	public function getAllCanBo(){
		return canbo::with('quyen')->get();
	}


	public function changePWD($id,$pwd){
		canbo::where('cb_id',$id)->update([
			'password'=>bcrypt($pwd)
		]);
	}

	public function create($ten,$diachi,$sdt,$email,$password){
		$canbo = new canbo();
		$canbo->cb_ten = $ten;
		$canbo->cb_diachi = $diachi;
		$canbo->cb_sdt = $sdt;
		$canbo->email = $email;
		$canbo->password = bcrypt($password);
		$canbo->q_ma = 2;
		$canbo->save();
	}
	

	public function editCB($ten,$diachi,$sdt,$id){
		canbo::where('cb_id',$id)
		->update([
			'cb_ten'=>$ten,
			'cb_sdt'=>$sdt,
			'cb_diachi'=>$diachi
		]);
	}

	public function deleteCB($id){
		canbo::where('cb_id',$id)->delete();
	}

}

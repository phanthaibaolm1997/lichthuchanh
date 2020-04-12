<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maytinh extends Model
{
    protected $table = "maytinh";
    public $primaryKey = "mt_ma";

    // Relationship
	public function loaimay(){
		 return $this->belongsTo('App\loaimay', 'lm_ma');
	}
	public function phong(){
		 return $this->belongsTo('App\phong', 'phong_stt');
	}
	public function tinhtrang(){
		 return $this->belongsTo('App\tinhtrang', 'tinhtrang_ma');
	}
}

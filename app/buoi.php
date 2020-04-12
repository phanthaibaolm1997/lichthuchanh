<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buoi extends Model
{
    protected $table = "buoi";
    public $primaryKey = "buoi";

    // Quan hệ
	public function tkb(){
		return $this->hasMany('App\tkb', 'buoi');
	}


}

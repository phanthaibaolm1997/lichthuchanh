<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thu extends Model
{
    protected $table = "thu";
    public $primaryKey = "thu";
    public $incrementing = false;


    public function tkb(){
		return $this->hasMany('App\tkb', 'thu');
	}

	//DAta 
	public function getAllThu(){
		return thu::all();
	}
}

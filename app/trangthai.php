<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trangthai extends Model
{
    protected $table = "trangthai";
    public $primaryKey = "tt_id";

    public function tkb(){
		return $this->hasMany('App\tkb', 'tt_id');
	}
}

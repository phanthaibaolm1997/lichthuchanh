<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tuan extends Model
{
    protected $table = "tuan";
    public $primaryKey = "tuan";

    public function tkb(){
		return $this->hasMany('App\tkb', 'tuan');
	}
}

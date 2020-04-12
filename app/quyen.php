<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quyen extends Model
{
    protected $table = "quyen";
    public $primaryKey = "q_ma";

    public function canbo(){
		return $this->hasMany('App\canbo', 'q_ma');
	}
}

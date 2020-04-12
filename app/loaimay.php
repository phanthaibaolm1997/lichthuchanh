<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaimay extends Model
{
    protected $table = "loaimay";
    public $primaryKey = "lm_ma";

    public function maytinh(){
		return $this->hasMany('App\maytinh', 'lm_ma');
	}
}

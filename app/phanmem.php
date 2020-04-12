<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phanmem extends Model
{
    protected $table = "phanmem";
    public $primaryKey = "pm_id";
    
    // Quan hệ
	public function version_software(){
		 return $this->belongsTo('App\version_software', 'ver_ma');
	}
}

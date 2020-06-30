<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class yeucau extends Model
{
    protected $table = "yeucau";
    public $timestamps = false;

    // Quan hệ
	public function phanmem(){
		 return $this->belongsTo('App\phanmem', 'pm_id');
	}
	public function nhomthuchanh(){
		 return $this->belongsTo('App\nhomthuchanh', 'sttnhom')->with('phanmem');
    }
    
    public function deleteYC($stt){
        yeucau::where('sttnhom',$stt)->delete();
    }
    public function createYC($stt,$pm){
        $create = new yeucau();
        $create->pm_id = $pm;
        $create->sttnhom = $stt;
        $create->save();
    }

    public function allRequestCourse($key){
        return yeucau::where('sttnhom',$key)->pluck('pm_id')->toArray();
    }

    
}

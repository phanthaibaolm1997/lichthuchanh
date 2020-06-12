<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\phong;
use App\tuan;
use App\thu;
use App\buoi;
use App\tkb;
use App\hocphan;
use Carbon\Carbon;
use App\lophocphan;
use App\phanmem;
use App\yeucau;
use Session;

class IndexController extends Controller
{
    public function __construct(){
        //variable protected
        $this->thisYear = Carbon::now()->year;
        $this->thisMonth = Carbon::now()->month;
        $this->thisSchoolYear = $this->thisYear."-".($this->thisYear+1);
    }
    //function protected
    public function checkSemester($month){
        $monthInHK = array(8,9,10,11,12);
        if(in_array($month, $monthInHK)){
           return  1;
        }
        return 2;  
    }

    public function getSessionCanBo(){
        if(Session::get('session_canbo_id')){
            return Session::get('session_canbo_id');
        }
        return 1;
    }

    //function use in router
    public function getIndex(Request $request){
    	$phong = new phong();
    	$tuan = new tuan();
    	$thu = new thu();
    	$buoi = new buoi();
    	$tkb = new tkb();

        $semester = $this->checkSemester($this->thisMonth);

    	$data['getAllPhong'] = $phong->getAllPhong();
    	$data['getAllTuan'] = $tuan->getAllTuan();
    	$data['getAllThu'] = $thu->getAllThu();
    	$data['getAllBuoi'] = $buoi->getAllBuoi();
    	$data['getLichThucHanh'] = $tkb->getTKBHK($this->thisSchoolYear,$semester);
        // dd($data);
    	return view('page.index',$data);
    }
    public function getDKL(Request $request){
        $phong = new phong();
        $tuan = new tuan();
        $thu = new thu();
        $buoi = new buoi();
        $tkb = new tkb();
        $hocphan = new hocphan();

        $cb_id = $this->getSessionCanBo();
        $semester = $this->checkSemester($this->thisMonth);

        $data['getHocPhanByCB'] = $hocphan->getHocPhanByCB($cb_id,$semester,$this->thisSchoolYear);
        $data['getLichThucHanh'] = $tkb->getTKBHK($this->thisSchoolYear,$semester);
        $data['getAllPhong'] = $phong->getAllPhong();
        $data['getAllTuan'] = $tuan->getAllTuan();
        $data['getAllThu'] = $thu->getAllThu();
        $data['getAllBuoi'] = $buoi->getAllBuoi();

        return view('page.dangkylich',$data);
    }
    public function getQLDK(Request $request){
        $phong = new phong();
        $tuan = new tuan();
        $thu = new thu();
        $buoi = new buoi();
        $tkb = new tkb();
        $hocphan = new hocphan();

        $cb_id = $this->getSessionCanBo();
        $semester = $this->checkSemester($this->thisMonth);


        $data['getHocPhanByCB'] = $hocphan->getHocPhanByCB($cb_id,$semester,$this->thisSchoolYear);
        // dd($data['getHocPhanByCB']);
        $data['getLichThucHanh'] = $tkb->getTKBHK($this->thisSchoolYear,$semester);
        $data['getAllPhong'] = $phong->getAllPhong();
        $data['getAllTuan'] = $tuan->getAllTuan();
        $data['getAllThu'] = $thu->getAllThu();
        $data['getAllBuoi'] = $buoi->getAllBuoi();

        return view('page.quanlydangky',$data);
    }
    public function postDKL(Request $request){
        $buoi = $request->formBuoi;
        $thu = $request->formThu;
        $tuan = $request->formTuan;
        $phong = $request->formPhong;
        $nhom = $request->formNhom;

        $tkb = new tkb();
        $tkb->createTKB($thu,$buoi,$tuan,$phong,$nhom);
        return back();

    }

    public function postMessenger(Request $request){
        $buoi = $request->formBuoi;
        $thu = $request->formThu;
        $tuan = $request->formTuan;
        $phong = $request->formPhong;
        $notify = $request->notify;
        $tkb = new tkb();
        $tkb->updateMessengerTKB($thu,$buoi,$tuan,$phong,$notify);
        return back();
    }

    public function deleteTKB(Request $request){
        $buoi = $request->formBuoi;
        $thu = $request->formThu;
        $tuan = $request->formTuan;
        $phong = $request->formPhong;
        $tkb = new tkb();
        $tkb->deleteTKB($thu,$buoi,$tuan,$phong);
        return back();
    }

    public function goBackHome(){
        return view('page.home');
    }

    public function getLHP(){
        $cb_id = $this->getSessionCanBo();
        $semester = $this->checkSemester($this->thisMonth);

        $lophocphan = new lophocphan();
        $phanmem = new phanmem();
        $data['allLHP'] = $lophocphan->getAllLHPCB($cb_id,$semester,$this->thisSchoolYear);
        $data['allPM'] = $phanmem->getAllPM();

        return view('page.lophocphan',$data);    
    }

    public function yeuCau(Request $request){
        $cb_id = $this->getSessionCanBo();
        $sttnhom = $request->sttnhom;
        $phanmem = $request->pm_id;
        $yeucau = new yeucau();

        $yeucau->deleteYC($sttnhom);
        foreach ($phanmem as $pm) {
            $yeucau->createYC($sttnhom,$pm);
        } 
        return back();
    }

    public function xacNhan($id, Request $request){
        $id = $request->id;
        $tkb = new tkb();
        $tkb->updateXacNhan($id);
        return back();

    }
    public function tuChoi($id, Request $request){
        $id = $request->id;
        $tkb = new tkb();
        $tkb->deleteSTTNhom($id);
        return back();

    }

    
}

    


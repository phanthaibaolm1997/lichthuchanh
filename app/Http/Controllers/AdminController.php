<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phong;
use App\tuan;
use App\thu;
use App\buoi;
use App\tkb;
use App\hocphan;
use App\phanmem;
use App\phanmemphong;
use App\version_software;
use App\canbo;
use DB;
use Carbon\Carbon;
use Session;


class AdminController extends Controller
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

    	return view('admin.contents.index',$data);
    }

     public function getTKBAdmin(Request $request){
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

    	return view('admin.contents.changelich',$data);
    }

    public function postChangeLich(Request $request){
    	$buoi = $request->formBuoi;
        $thu = $request->formThu;
        $tuan = $request->formTuan;
        $phong = $request->formPhong;
        $nhom = $request->formNhom;

        $tkb = new tkb();
        $tkb->updateNhom($thu,$buoi,$tuan,$phong,$nhom);
        return back();
    }

    public function getHocPhan(Request $request){
        $hocphan = new hocphan();

        $data['getAllHP'] = $hocphan->getAllHP(10);
        // dd($data);

        return view('admin.contents.hocphan',$data);
    }

    public function getPhanMem(Request $request){
        $phanmem = new phanmem();
        $version_software = new version_software();

        $data['getAllPM'] = $phanmem->getAllPM();
        $data['getAllVersion'] = $version_software->getAllVersion();

        // dd($data);

        return view('admin.contents.phanmem',$data);
    }

    public function postPhanMem(Request $request){
        $phanmem = new phanmem();
        $name = $request->name;

        $phanmem->createPM($name);

        return redirect()->back()->with('success', 'Tạo mới thành công!');
    }

    public function postPhanMemVer(Request $request){
        $version_software = new version_software();

        $pm_id = $request->pm_id;
        $version = $request->version;
        // $ver_ma = $request->ver_ma;
        $ver_ma = DB::table('version_software')->max('ver_ma');
        $ver_ma = $ver_ma + 1;

        $version_software->createVersion($pm_id,$ver_ma,$version);
        return redirect()->back()->with('success', 'Tạo mới thành công!');
    }

    public function postPhanMemEdit(Request $request){
        $phanmem = new phanmem();

        $pm_id = $request->pm_id;
        $name = $request->name;

        $phanmem->editPM($name,$pm_id);

        return redirect()->back()->with('success', 'Sửa thành công!');

    }

    public function delPhanMem(Request $request){
        $phanmem = new phanmem();
        $phanmem->delPhanMem($request->pm_id);
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
    public function delPhanMemVersion(Request $request){
        $version_software = new version_software();
        $version_software->delPhanMemVersion($request->pm_id,$request->ver_ma);
        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function getPhong(){
        $phong = new phong();

        $data['getAllPhong'] = $phong->getAllPhong();

       return view('admin.contents.phong',$data);
    }

    public function postPhong(Request $request){
        $phong = new phong();

        $name = $request->name;
        $soluong = $request->soluong;

        $phong->createPhong($name,$soluong);

       return redirect()->back()->with('success', 'Tạo mới thành công!');
    }

    public function editPhong(Request $request){
        $phong = new phong();

        $name = $request->name;
        $soluong = $request->soluong;
        $id = $request->id;

        $phong->editPhong($name,$soluong,$id);

       return redirect()->back()->with('success', 'Tạo mới thành công!');
    }

    public function getDetailPhong(Request $request, $id){
        $phong = new phong();
        $phanmem = new phanmem();
        $data['getDetailPhong']= $phong->getDetail($id);
        $data['getAllPM'] = $phanmem->getAllPM();
        // dd($data);
        return view('admin.contents.phongdetail',$data);
    }

    public function ajaxGetVersion(Request $request){
        $id = $request->id;
        $version_software = new version_software();

        $data = $version_software->ajaxGetVersion($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function addSoftware(Request $request){
        $phong_stt = $request->phong_stt;
        $ver_ma = $request->ver_ma;
        $pm_id = $request->pm_id;

        $phanmemphong = new phanmemphong();

        $phanmemphong->create($phong_stt,$ver_ma,$pm_id);
        return redirect()->back()->with('success', 'Tạo mới thành công!');

    }

    public function delSoftware($phong, $version, $phanmem){
        $phanmemphong = new phanmemphong();
        $phanmemphong->deletePMP($phong, $version, $phanmem);
        return redirect()->back()->with('success', 'Xóa mới thành công!');
    }


    public function getCanBo(Request $request){
        $canbo = new canbo();

        $data['getAllCanBo'] = $canbo->getAllCanBo();

        return view('admin.contents.canbo',$data);
    }

    public function changePWD(Request $request){
        $id = $request->cb_id;
        $pwd = $request->password;

        $canbo = new canbo();
        $canbo->changePWD($id,$pwd);
        return redirect()->back()->with('success', 'Thay đổi thành công!');
    }

    public function postCanBo(Request $request){
        $password = $request->password;
        $email = $request->email;
        $sdt = $request->sdt;
        $ten = $request->ten;
        $diachi = $request->diachi;

        $canbo = new canbo();
        $canbo->create($ten,$diachi,$sdt,$email,$password);
        return redirect()->back()->with('success', 'Thêm thành công!');
    }

    public function editCanBo(Request $request){
        $sdt = $request->sdt;
        $ten = $request->ten;
        $diachi = $request->diachi;
        $id = $request->id;

        $canbo = new canbo();
        $canbo->editCB($ten,$diachi,$sdt,$id);
        return redirect()->back()->with('success', 'Thêm thành công!');
    }

    public function deleteCB($id){
        $canbo = new canbo();
        $canbo->deleteCB($id);
        return redirect()->back()->with('success', 'Delte thành công!');
    }
}

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
use App\nhomthuchanh;
use App\canbo;
use App\yeucau;
use Carbon\Carbon;

class SapLichController extends Controller
{


    public function __construct(){
        $this->thisYear = Carbon::now()->year;
        $this->thisMonth = Carbon::now()->month;
        $this->thisSchoolYear = $this->thisYear."-".($this->thisYear+1);
    }

    protected function _CheckSemester($coloronth){
        $coloronthInHK = array(8,9,10,11,12);
        if(in_array($coloronth, $coloronthInHK)){
           return  1;
        }

        return 2;  
    }
    protected function _CalendarOfWeek($week){
        $tkb = new tkb();
        $semester = $this->_CheckSemester($this->thisMonth);
        $calendar = $tkb->calendarOfWeek($this->thisSchoolYear,$semester,$week);
        return $calendar;
    }
    protected function _AllOfDay(){
        $thu = new thu();
        $days = $thu->getAllThu();
        return $days;
    }
    protected function _AllOfRoom(){
        $phong = new phong();
        $room = $phong->getAllPhong();
        return $room;
    }
    protected function _AllOfWeek(){
        $tuan = new tuan();
        $tuan = $tuan->getAllTuan();
        return $tuan;
    }
    protected function _AllGroup(){
        $nhomthuchanh = new nhomthuchanh();
        $group = $nhomthuchanh->getAllNhom();
        return $group;
    }

    public function autoScheduling(Request $request){
        $data['allGroup'] = $this->allPracticeGroup();


        return view('admin.contents.auto_schedule',$data);
    }
    public function allPracticeGroup(){
        $nhomthuchanh = new nhomthuchanh();
        $week = 1;
        $semester = $this->_CheckSemester($this->thisMonth);
        $calendar = $nhomthuchanh->allPracticeGroup($this->thisSchoolYear,$semester);
        return $calendar;
    }

    public function allRequestCourse($courses){
        $PMRoom = $this->getPMYCRoom();
        $yeucau = new yeucau();
        $nhomthuchanh = new nhomthuchanh();
        $arrReturn = [];
        foreach ($courses as $course) {
            $arrTemp = [];
            foreach ($course as $key) {
                $hihi = [];
                $data = $yeucau->allRequestCourse($key);
                array_push($hihi,[$key,$data]);
                array_push($arrTemp,$hihi);
            }
            //trả về mảng [sttnhom, [pm_id]]
            array_push($arrReturn,$arrTemp); 
        }

        $dataXYZ = [];
        foreach($arrReturn as $arr){
            
            $rooms = $PMRoom;
            $arrTemp = [];
            $soluong = $nhomthuchanh->getSiSo($arr[0][0])->nth_siso;
            //sắp xếp theo giảm dần số lượng phần mềm yêu cầu
            usort($arr, function ( $arr2,$arr1) {
                return count($arr1[0][1]) <=> count($arr2[0][1]);
            });

            foreach ($arr as $a) {
                //lấy mảng pm_id
               $pm_req = $a[0][1];
               $arrPMAccept = [];
                foreach ($rooms as $room) {
                    //so sánh mảng pm_id với phần mềm có trong từng phòng
                    if(array_intersect($pm_req,$room[1]) && $room[2] >= $soluong){
                        //nếu khớp với nhau thì sẽ cho stt_phòng đó vào mảng
                        array_push($arrPMAccept,$room[0]);
                    }
                }
                // sắp xếp theo tăng dần số lượng môn học có phần mềm thích hợp
               array_push($arrTemp,[$a[0][0],$arrPMAccept]);
            }
            usort($arrTemp, function ($arrTemp1,$arrTemp2) {
                return count($arrTemp1[1]) <=> count($arrTemp2[1]);
            });
            array_push($dataXYZ,$arrTemp);
        }
        $data = [];
        foreach ($dataXYZ as $obj) {
            $arrEx = [];
            $arrFake = [];
            foreach($obj as $o){
                for ($i = 0; $i <= count($o) ; $i++) { 
                    if(!in_array($o[1][$i],$arrEx)){
                        array_push($arrEx,$o[1][$i]);
                        array_push($arrFake,[$o[0],$o[1][$i]]);
                        break;
                    }
                }
            }
            array_push($data,$arrFake);
        }   
        return $data;
    }

    public function getPMYCRoom(){
        $phong = new phong();
        $data = $phong->getPMYCRoom();
        return $data;
    }

    protected function convertData($data){
        $resultData = [];
        $resultVertices = [];
        $arrTemp = [];
        $swag = array();
        $index = 1;
        $len = count($data);
        foreach ($data as $obj) {
            $keyGV = $obj->lophocphan->canbo->cb_id;
            $key = [$obj->sttnhom,$keyGV];

            array_push($resultVertices, $key);
            if(in_array($keyGV , $arrTemp)){
                array_push($swag[$keyGV], $index);
            }else{
                $swag[$keyGV] = array();
                array_push($swag[$keyGV], $index);
                array_push($arrTemp, $keyGV);
            }
            $index++;
        }
        
        $check = 1; 
        foreach ($swag as $key => $sw) {
            $k = count($sw) + $check;
            for ($i= $check; $i <$k; $i++) { 
                for ($j= $i+1; $j < $k; $j++) { 
                    $degress = array($i,$j);
                    array_push($resultData, $degress); 
                }
                $check++;
            }
        }
        array_push($resultData, end($resultData));
        return [$resultData,$resultVertices];
    }

    protected function graphColoring_AntiDuplicate($arrDegrees,$vertices){
        $check = 0;
        $color = array_fill(0, $vertices +1, 0);
        $temp = 0;
        $resultData = array();
        for ($i= 1; $i <= $vertices ; $i++) { 
            if(!$color[$i]){
                $temp++;
                $color[$i] = $temp;
                for ($j = $i+1; $j <= $vertices ; $j++) { 
                    if(($arrDegrees[$i][$j] == 0) && ($color[$j] == 0)){
                        $check = 1;
                        for($k = $i+1; $k < $j; $k++ ){
                            if(($arrDegrees[$k][$j] == 1) && ($color[$i] == $color[$k])){
                                $check = 0;
                                break;
                            }
                        }
                        if($check == 1){
                            $color[$j] = $temp;
                        } 
                    }
                }
            }
        }

        for ($s = 1; $s <= $temp ; $s++) { 
            $tempData = [];
            for ($g = 1; $g <= $vertices ; $g++) { 
                if($color[$g] == $s){
                    array_push($tempData,$g);
                }
            }
            array_push($resultData,$tempData);
        }
        return $resultData;
    }

    protected function toCourseCode($dataVertices,$dataSort){
        $resultData = [];
        for ($i= 0; $i < count($dataSort) ; $i++) { 
            $tempData = [];
            foreach ($dataSort[$i] as $o) {
                $number = $o-1;
                array_push($tempData, $dataVertices[$number][0]);
            }
            array_push($resultData, $tempData);
        }
        return $resultData;
    }
    protected function _updateStatusGroup($courses){
        $nhomthuchanh = new nhomthuchanh();
        foreach ($courses as $course) {
            foreach ($course as $sttnhom) {
               $nhomthuchanh->updateStatus($sttnhom[0],1);
            }
        }
    }

    protected function autoCreateCalender($dataInsert){
        $day = $this->_AllOfDay();
        $weeks = $this->_AllOfWeek();
        $tkb = new tkb();
        foreach ($weeks as $week) {
            $checkSession = 1;
            $numDay = 0;
            foreach ($dataInsert as $dataI) {
                $numRoom = 0;
                foreach ($dataI as $data) {
                    if($checkSession%2 == 0){
                        $buoi = "Chiều";
                    }else{
                        $buoi = "Sáng";
                    }
                    
                    $tkb->createTKB(
                        $day[$numDay]->thu,
                        $buoi,
                        $week->tuan,
                        $data[1],
                        $data[0]);
                    $numRoom++;
                }
                if($checkSession%2 == 0){
                    $numDay++;
                }
                $checkSession++;
            }
        }
    }

    public function AutoSortCalender(Request $request){
        $resultData = $this->allPracticeGroup();
        [$data,$dataVertices] = $this->convertData($resultData);
        $vertices = count($dataVertices);
        $arrDegrees = array_fill(0, $vertices+1, array_fill(0, $vertices+1, 0));
        for($i = 0; $i < count($data); $i++){ 
            $x = $data[$i][0];
            $y = $data[$i][1];
            $arrDegrees[$x][$y] = 1;
            $arrDegrees[$y][$x] = 1;
        }
        $resultSort = $this->graphColoring_AntiDuplicate($arrDegrees,$vertices);  
        $resultCourse = $this->toCourseCode($dataVertices,$resultSort);
        $dataInsert = $this->allRequestCourse($resultCourse);
        $this->autoCreateCalender($dataInsert);

        $this->_updateStatusGroup($dataInsert);
        
        return redirect()->route('auto')->with('success', 'Tạo lịch thành công!');
    }


}

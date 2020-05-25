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
                $swag[$keyGV]= array();
                array_push($swag[$keyGV], $index);
                array_push($arrTemp, $keyGV);
            }

            $index++;
        }
        
        foreach ($swag as $sw) {
            $check = 1;

            for ($i= $sw[0]; $i < count($sw) + $sw[0]  ; $i++) { 

                $k = count($sw) + $sw[0];
                for ($j= $i+1; $j < $k; $j++) { 
                    $degress = array($i,$j);
                    array_push($resultData, $degress); 
                }
            }
        }
        array_push($resultData, end($resultData));

        return [$resultData,$resultVertices];
    }

    protected function graphColoring($arrDegrees,$vertices){
        $check = 0;
        $color = array_fill(0, $vertices+1, 0);
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
               $nhomthuchanh->updateStatus($sttnhom,1);
            }
        }
    }
    protected function sortRoom($courses){
        $nhomthuchanh = new nhomthuchanh();
        $phong = new phong();
        $arrRoomResult = array();
        $room = $phong->getComputerofRoom();

        usort($room, function ($room1, $room2) {
            return $room1['phong_slmay'] <=> $room2['phong_slmay'];
        });

        foreach ($courses as $course) {
            $dataSiso = $nhomthuchanh->getSiSo($courses);
            $siso = $dataSiso->nth_siso;
            for ($i=0; $i < count($room) ; $i++) { 
                $numComputer = $room[$i]['phong_slmay'];
                if( $numComputer >= $siso){
                    array_push($arrRoomResult,$room[$i]['phong_stt']);
                    unset($room[$i]);
                    $room = array_values($room);
                    break;
                }
            } 
        }

        return $arrRoomResult;
    }

    protected function autoCreateCalender($courses,$rooms){
        $day = $this->_AllOfDay();
        $weeks = $this->_AllOfWeek();
        $tkb = new tkb();

        foreach ($weeks as $week) {
            $checkSession = 1;
            $numDay = 0;
            foreach ($courses as $course) {
                $numRoom = 0;
                foreach ($course as $sttnhom) {
                    if($checkSession%2 == 0){
                        $buoi = "Chiều";
                    }else{
                        $buoi = "Sáng";
                    }
                    
                    $tkb->createTKB(
                        $day[$numDay]->thu,
                        $buoi,
                        $week->tuan,
                        $rooms[$numRoom],
                        $sttnhom);
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

        for($i = 0; $i < count($data); $i++){ 
            $x = $data[$i][0];
            $y = $data[$i][1];
            $arrDegrees[$x][$y] = 1;
            $arrDegrees[$y][$x] = 1;
        }

        $resultSort = $this->graphColoring($arrDegrees,$vertices);
        $resultCourse = $this->toCourseCode($dataVertices,$resultSort);
        $room = $this->sortRoom($resultCourse);
        $this->autoCreateCalender($resultCourse,$room);

        $this->_updateStatusGroup($resultCourse);
        
        return redirect()->route('auto')->with('success', 'Tạo lịch thành công!');
    }


}

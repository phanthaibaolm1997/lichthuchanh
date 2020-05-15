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
	private $adjacencyMatrix;       // connection/adjacency table
    private $colorsVector;          // list of colors
    private $coloredVertices;       // lost of colored vertices
    private $matrixSize = 0;        // size of $adjacencyMatrix
    private $chromaticNo = 0;       // finale chormatic number after coloring

	public function __construct($sizeMatrix){
		$this->thisYear = Carbon::now()->year;
		$this->thisMonth = Carbon::now()->month;
		$this->thisSchoolYear = $this->thisYear."-".($this->thisYear+1);

		// init adjacency table
        $this->matrixSize = $sizeMatrix;
        for($i = 0; $i < $this->matrixSize; $i++) {
            for ($y = 0; $y < $this->matrixSize; $y++) {
                $this->adjacencyMatrix[$i][$y] = 0;
            }
        }
        // init colors vector = result of coloring
        $this->colorsVector[0] = 0;
        for($i=1;$i < $this->matrixSize; $i++) { $this->colorsVector[$i] = -1; }
        // init colored vertices
        for($i=0;$i < $this->matrixSize; $i++) { $this->coloredVertices[$i] = false; }
	}

	protected function _CheckSemester($month){
		$monthInHK = array(8,9,10,11,12);
		if(in_array($month, $monthInHK)){
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
	protected function _AllGroup(){
		$nhomthuchanh = new nhomthuchanh();
		$group = $nhomthuchanh->getAllNhom();
		return $group;
	}
	protected function _ScoresOfCalendar(){
		$week = 1;
		$arrScore = [];

		// $calendarOfWeek = $this->_CalendarOfWeek($week);
		$allOfDay = $this->_AllOfDay();
		$allOfRoom = $this->_AllOfRoom();
		$allGroup = $this->_AllGroup();
		foreach ($allGroup as $group) {
			$number = $group->nth_siso;

		}
	}

	public function autoScheduling(Request $request){
		$week = 1;
		// $data['calendarOfWeek'] = $this->_CalendarOfWeek($week);
		// $data['allOfDay'] = $this->_AllOfDay();
		// $data['allOfRoom'] = $this->_AllOfRoom();
		$this->_ScoresOfCalendar();

		return view('admin.contents.auto_schedule',$data);
	}

	// XXXXXXXXXXXXXXXXXXXXXXXXXXX
    
    public function listElements() {
        echo "__ |";
        for ($y = 0; $y < $this->matrixSize; $y++) {
            echo $y . " | ";
        }
        echo "<br>\n";
        for($i = 0; $i < $this->matrixSize; $i++) {
            echo $i." | ";
            for ($y = 0; $y < $this->matrixSize; $y++) {
                echo $this->adjacencyMatrix[$i][$y]." | ";
            }
            echo "<br>\n";
        }        
    }
    
    public function getColors() {
        echo "<p>\n";
        for ($i = 0; $i < $this->matrixSize; $i++)
            echo "Vertex " .$i. " --->  Color " .$this->colorsVector[$i]."<br>\n";
        echo "</p>\n";
    }

    public function getAdjacencyMatrix() {
        return $this->adjacencyMatrix;
    }
    
    public function getColorsVector() {
        return $this->colorsVector;
    }
    
    public function getChromaticNo() {
        for($i = 0; $i < count($this->colorsVector); $i++) {
            if ($this->colorsVector[$i] > $this->chromaticNo) { $this->chromaticNo = $this->colorsVector[$i]; }          
        }        
        return ++$this->chromaticNo;
    }

    public function setVertex($row,$column) {
        if($row > $this->matrixSize || $column > $this->matrixSize) { return false; }
        $this->adjacencyMatrix[$row][$column] = $this->adjacencyMatrix[$column][$row] = 1;
        return true;
    }
    
    public function coloringGraph() {
        for ($j = 1; $j < $this->matrixSize; $j++) {
            // Color adjacent vertices with different colors
            for ($i = 0; $i < $this->matrixSize; $i++) {
                if ( ($this->colorsVector[$i] != -1) && ($this->adjacencyMatrix[$j][$i] > 0) ) {
                    $this->coloredVertices[$this->colorsVector[$i]] = true;
                }
            }
            // Search the 1st free color
            for ($cr = 0;$cr < $this->matrixSize; $cr++) 
                if ($this->coloredVertices[$cr] == false)
                    break;
            $this->colorsVector[$j] = $cr;
            // Reset for next iteration         
            for ($i = 0; $i < $this->matrixSize; $i++) {
                if ( ($this->colorsVector[$i] != -1) && ($this->adjacencyMatrix[$j][$i] > 0) ) {
                    $this->coloredVertices[$this->colorsVector[$i]] = false;
                }
            }
        }
    }

    public function __destruct() {
        reset($this->adjacencyMatrix);
        reset($this->coloredVertices);
        reset($this->colorsVector);        
        $this->matrixSize = 0;
        $this->chromaticNo = 0;
    }

}

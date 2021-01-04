<?php 
$filepath= realpath(dirname(__FILE__));
include_once ($filepath.'/Database.php');
?>
<?php
class Student {
private $db;

    public function __construct(){
        $this->db=new Database();
    }

    public function get_students(){
        $query='SELECT *FROM tbl_student';
        $result= $this->db->select($query);
        return $result;
        }
    public function insertStudent($name,$roll){
        $name= mysqli_real_escape_string($this->db->link,$name);
        $roll= mysqli_real_escape_string($this->db->link,$roll);
        if (empty($name)||empty($roll)){
            $msg= "<div class='alert alert-danger'><strong>Error!</strong> Field must not be empty!!!</div>";
            return $msg;
        } else {
            $std_query="INSERT INTO tbl_student(name,roll)VALUES('$name','$roll')";
            $std_insert=$this->db->insert($std_query);
            
            $att_query="INSERT INTO tbl_attendance( roll)VALUES('$roll')";
            $att_insert=$this->db->insert($att_query);
            
            if ($std_insert){
                $msg="<div class='alert alert-success '><strong>Sucess! </strong> Student inserted sucessfully!!!</div>";
                return $msg;
            } else {
                $msg= "<div class='alert alert-danger text-center'><strong>Error!</strong> Field must not be empty!!!</div>";
                return $msg;
            }
        }
        
    }
    public function insertAttendance($attend=array(),$cur_date){
        $query = "SELECT DISTINCT attendance_time FROM tbl_attendance";
        $getData= $this->db->select($query);
        while ($result=$getData->fetch_assoc()){
            $db_date=$result['attendance_time'];
            if($cur_date==$db_date){
                 $msg="<div class='alert alert-danger'><strong>Error! </strong> Attendance already taken today!!!</div>";
                 return $msg;
            }
        }
        foreach ($attend as $atn_key => $atn_value) {
            if ($atn_value=="present") {
                $std_query="INSERT INTO tbl_attendance (roll,attendance,attendance_time)VALUES('$atn_key','present',now())";
                $attendance_insert= $this->db->insert($std_query);
            } elseif($atn_value=="absent") {
                $std_query="INSERT INTO tbl_attendance (roll,attendance,attendance_time)VALUES('$atn_key','absent',now())";
                $attendance_insert= $this->db->insert($std_query);
            }
        }
         if ($attendance_insert){
                $msg="<div class='alert alert-success '><strong>Sucess! </strong> Attendance taken sucessfully!!!</div>";
                return $msg;
            } else {
                $msg= "<div class='alert alert-danger'><strong>Error!</strong> Attendance culd not taken!!!</div>";
                return $msg;
            }
    }
    // code for view attendance
    public function getDateList(){
        $query = "SELECT DISTINCT attendance_time FROM tbl_attendance";
        $resul= $this->db->select($query);
        return $resul;
    }
    
    
    
}
?>

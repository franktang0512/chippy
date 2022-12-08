<?php
// print_r($_POST);
//這邊需要的資訊有:課程名稱、老師id、學校id、年級、學年
//評量狀態先設為0
//
session_start();
include("inc/func.php");
include("inc/conn.php");
// echo date('Y-m-d');



//todo:建立班級
$sql = "SELECT c_id FROM classes";
$result = mysqli_query($conn,$sql);
$numOfrow = mysqli_num_rows($result);

$classname = $_POST["classname"];

$tea_acc = $_SESSION["account"];
$sql_tea = "SELECT teachers.t_id,teachers.sch_id FROM teachers INNER JOIN users ON users.u_id=teachers.u_id AND users.u_acc = '".$tea_acc."'";
// echo $sql_tea;

$result = mysqli_query($conn,$sql_tea);
// echo mysqli_num_rows($result);
$row= mysqli_fetch_array($result);

$tea_id = $row[0];
// echo $tea_id;
$sch_id = $row[1];
// echo $sch_id;

 $grade = $_POST["grade"];

$term=0;
if((date('m')<=12&&date('m')>=8)||(date('m')<2&&date('m')>=1)){
    $term=1;
}else{
    $term=2;
}
$sql_class = "INSERT INTO `classes` (`c_id`, `c_name`, `tea_id`, `sch_id`, `c_grade`, `year`, `term`, `exam_status`)
            VALUES ('".$numOfrow."','".$classname."','".$tea_id."','".$sch_id."','".$grade."','".date('Y')."','".$term."','"."0"."')";
// echo $sql_class;
$result = mysqli_query($conn,$sql_class);


//todo:建立學生
if(isset($_SESSION["students_list"])){
    $sql_stu = "SELECT COUNT(*) FROM `students`";
    $result= mysqli_query($conn,$sql_stu);
    $row = mysqli_fetch_array($result);
    $allstudentnum = $row[0];

    $students = json_decode($_SESSION["students_list"]);
    $sql_add_stu ="INSERT INTO `students` (`stu_no`, `stu_id`, `c_id`, `s_name`, `gender`) VALUES ";

    for($i=0;$i<count($students);$i++){
        $student = json_encode($students[$i]);
        $student_data = json_decode($student);
        $stu_id= $student_data->Student_ID;
        $stu_name= $student_data->Student_Name;
        $stu_gender= $student_data->Gender;    
        $sql_add_stu.="('".($allstudentnum+$i)."','".$stu_id."','".$numOfrow."','".$stu_name."','".($stu_gender=="男"?"1":"2")."')".($i==count($students)-1?"":",");
    
    }
    $result= mysqli_query($conn,$sql_add_stu);

}



header("Location:tea_class_manage.php");

?>
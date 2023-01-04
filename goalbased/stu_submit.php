<?php
include("../inc/conn.php");
include("../inc/func.php");
session_start();

$s_no=$_SESSION["stu_no"];
$td_id=$_SESSION["td_id"];

$sql = "SELECT * FROM `saves` WHERE stu_no=" . $s_no . " AND td_id=" . $td_id . " ORDER BY upload_times
DESC";
$upload_times = 0;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)){
    $row = mysqli_fetch_array($result);
    $upload_times = $row[4]+1;

}else{
    $upload_times = 0;
}

$we = $_POST["we"];

$answer_result = $_POST["result"];
$sql = "INSERT INTO `saves` (`sa_id`, `stu_no`, `td_id`, `result`, `upload_times`,`tea_or_stu`,`scratch_or_blookly`) 
        VALUES (NULL, '".$s_no."', '".$td_id."', '".$answer_result."', '".$upload_times."',0,".$we.")";

if($_SESSION["u_level"]=='1'){
	$s_no=$_SESSION["s_no"];
	$sql = "INSERT INTO `saves` (`sa_id`, `stu_no`, `td_id`, `result`, `upload_times`,`tea_or_stu`,`scratch_or_blookly`) 
        VALUES (NULL, '".$s_no."', '".$td_id."', '".$answer_result."', '".$upload_times."',1,".$we.")";
}

//echo $sql;	
//exit;

$result = mysqli_query($conn, $sql);
if($result){
    echo "ok";

}else{
    echo "no";
}
write_log($conn);

?>
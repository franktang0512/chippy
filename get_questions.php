<?php
session_start();
include("inc/func.php");
include("inc/conn.php");

$showform = $_POST["showform"];
if ($showform == "tid"){
    $t_id = $_POST["t_id"];
    $_SESSION["t_id"]= $_POST["t_id"];
    if($_SESSION["t_id"]!=""){
        echo "ok";
    }



}else if($showform == "tdid"){
    $td_id = $_POST["td_id"];
    $_SESSION["td_id"]= $_POST["td_id"];
	//todo:想先取得blockly or scratch以便呈現介面

	//取得js path 及goal_or_problem
	$sql="SELECT DISTINCT task_example.jspath,task_example.e_problem_goal,task_example.e_id  FROM task_example INNER JOIN tasks_detail on task_example.e_id=tasks_detail.e_id AND tasks_detail.td_id =".$td_id." AND tasks_detail.disabled=0 AND task_example.disabled=0";
    $result = mysqli_query($conn, $sql);
	if(!$result){
		echo "err";
	}
	
	$row = mysqli_fetch_array($result);
	$_SESSION["e_id"]=$row[2];
	$_SESSION["jspath"]=$row[0];
	echo $row[1];//回傳是否為問題導向或目標導向
	
	
	
	
	
	
}




?>
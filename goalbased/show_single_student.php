<?php
include("../inc/conn.php");
session_start();



$s_no = $_POST["s_no"];

$td_id = $_SESSION["td_id"];


if ($_POST["func"] == "getstudent") {
    $_SESSION["s_no"] = $_POST["s_no"];
    $sql = "SELECT * FROM `saves` WHERE stu_no=" . $s_no . " AND td_id=" . $td_id . " ORDER BY upload_times
    DESC";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);
        echo $row[3];
    } else {
        // echo '<xml><block type="controls_repeat_ext" id="mc(7[SV)(1OAjfR~[PhW" x="117" y="92"><value name="TIMES"><shadow type="math_number" id="Y:3G6vkG,Mqb6tv-5)r}"><field name="NUM">10</field></shadow></value></block></xml>';
        echo "<xml></xml>";
    }
} else if ($_POST["func"] == "sub") {
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
    

    

    $answer_result = $_POST["result"];
    $sql = "INSERT INTO `saves` (`sa_id`, `stu_no`, `td_id`, `result`, `upload_times`) 
            VALUES (NULL, '$s_no', '$td_id', '$answer_result', '$upload_times')";
    echo $sql;
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "ok";

    }else{
        echo "no";
    }
    
}

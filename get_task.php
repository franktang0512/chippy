<?php
session_start();
include("inc/func.php");
include("inc/conn.php");

$showform = $_POST["showform"];
$content = "";
//接受按鈕按下後傳來了class id

if ($showform == "y") {
    $c_id = $_POST["c_id"];
    $_SESSION["c_id"] = $_POST["c_id"];

    $sql = "SELECT c_name,c_grade FROM `classes` WHERE c_id=" . $c_id." AND disabled=0";
     //echo $sql;
     //exit;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $content .= '
    <div class="row py-4">
        <div class="col">
            <div class="row my-1">
                <div class="col text-right">班級名稱：</div>';

    $content .= '<div class="col text-left">' . $row[0] . '</div>
                </div>
    
            <div class="row my-1 view" id="changeLevel"></div>
            <!--div class="row">
                <div class="col text-right">評量狀態：</div>
                <div class="col text-left" id="status">關閉 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-sm" onclick="change_exam_status(\'資一忠\', \'10\', \'G3\', 1)">開啟</button></div>
            </div-->
            <div class="row">
            <div class="col text-right">新增任務：</div>
            <div class="col text-left" id="status">
                <button class="btn" onClick="showinserttask()">新增</button>
            </div>
        </div>
    </div>
    </div>
    <div id="tasklist">
    <div id="studentnamelist">
    <div class="row py-4">
        <div class="col header">挑戰名稱</div>
		<div class="col header">設定預設積木</div>
		<div class="col header">評量狀態</div>
        <!--div class="col header"></div-->

    </div>
    ';


    //classname, 年級,(評量狀態),,

    $sql = "SELECT * FROM `tasks` WHERE c_id=" . $c_id." AND disabled=0";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $content .= '<div class="row py-4">
				
                <div class="col studentinfo">
                <input class="btn classnamebtn" onClick="edittask(this.id)" type="button" id="'.$row[0].'" value="'.$row[2].'"/>
                </div>
				<div class="col studentinfo">
				
					<input type="radio" name="'.$row[0].'" value="0" '.($row[5]==0?"checked":"").'  onchange="switch_bs(this);"><label>Blockly</label><br>
					<input type="radio"  name="'.$row[0].'" value="1" '.($row[5]==1?"checked":"").'  onchange="switch_bs(this);"><label>Scratch</label>
				
                </div>
				<div class="col studentinfo">
				
					<input type="radio" name="oc'.$row[0].'" value="0" '.($row[3]==0?"checked":"").'  onchange="opentostu(this);"><label>開放</label><br>
					<input type="radio"  name="oc'.$row[0].'" value="1" '.($row[3]==1?"checked":"").'  onchange="opentostu(this);"><label>關閉</label>
				
                </div>
            </div>';
    }


    $content .= "";
    echo $content;
} else if ($showform == "a") {
    $t_title = $_POST["t_title"];
    $c_id = $_SESSION["c_id"];
    // $sql = "SELECT COUNT(*) FROM `tasks`";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($result);

    $sql = "INSERT INTO `tasks` (`c_id`, `t_title`, `t_open_close`, `disabled`,`scratch_or_blookly`) 
                            VALUES ( '" . $c_id . "', '" . $t_title . "',0,0,0)";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "ok";
    } else {
        echo $sql;
        // echo "Error";
    }
}else if ($showform == "fe") {
    //forcus on example
    $t_id = $_POST["t_id"];

    $_SESSION["t_id"]=$_POST["t_id"];
    echo $_SESSION["t_id"];

}else if ($showform == "c") {
    $tlevel = $_POST["tlevel"];
	$sql="";
	if($tlevel == "0"){
		$sql = "SELECT * FROM `task_example` WHERE disabled=0";
	}else{
		$sql = "SELECT * FROM `task_example` WHERE e_level=".$tlevel." AND disabled=0";
	}

    
    
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    $tasklist="";
    $o_e=1;
    while($row = mysqli_fetch_array($result)){
        if($o_e%2==1){
            $tasklist .= '<div class="tasklist row odd"><input type="checkbox" id="task" name="task" value="'.$row[0].'"/>'.$row[1].'</div>';
        }else{
            $tasklist .= '<div class="tasklist row even"><input type="checkbox" id="task" name="task" value="'.$row[0].'"/>'.$row[1].'</div>';
        }
        $o_e++;
        
    }
    if($o_e!=1){
        $tasklist .='<div class="col pre"><input name="mod" type="button" id="" onClick="checktask()" value="確認題目"/></div>';
    }
    
    echo $tasklist;

}else if ($showform == "s") {
    $tlevel = $_POST["tlevel"];

    $sql = "SELECT * FROM `task_example` WHERE e_level=".$tlevel;
    $result = mysqli_query($conn, $sql);
    $tasklist="";
    $o_e=1;
    while($row = mysqli_fetch_array($result)){
        if($o_e%2==1){
            $tasklist .= '<div class="tasklist row odd"><input type="checkbox" id="task" name="task" value="'.$row[0].'"/>'.$row[1].'</div><br>';
        }else{
            $tasklist .= '<div class="tasklist row even"><input type="checkbox" id="task" name="task" value="'.$row[0].'"/>'.$row[1].'</div><br>';
        }
        $o_e++;
        
    }

    $tasklist .='<div class="col pre"><input name="mod" type="button" id="" onClick="checktask()" value="確認題目"/></div>';
    echo $tasklist;

}else if ($showform == "comfirm") {
    $t_id = $_SESSION["t_id"];

    $sql = "SELECT COUNT(*) FROM `tasks_detail` WHERE t_id = ".$t_id;

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $alltasks = $row[0];

    if($alltasks>0){
        echo "err";
        exit;
    }


    // $taskexamplelist = $_POST["taskexamplelist"];
    $taskexamplelist = json_decode($_POST["taskexamplelist"]);

    // echo $taskexamplelist[0];
    $sql = "SELECT COUNT(*) FROM `tasks_detail`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $alltasks = $row[0];

    $sql = "INSERT INTO `tasks_detail` (`t_id`, `e_id`,`disabled`) VALUES ";

    for($i=0;$i<count($taskexamplelist);$i++){
        $tes = json_encode($taskexamplelist[$i]);
        $te = json_decode($tes);
        $e_id= $te->e_id;
        $sql.='('.$t_id.','.$e_id.',0)'.($i==count($taskexamplelist)-1?"":",");

    }

     //echo $sql;
     //exit;
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "ok";
    }else{
        echo "error";
    }
    // echo $taskexamplelist;

}else if ($showform == "bs") {
	$t_id = $_POST["t_id"];
	$bs = $_POST["bs"];
	$sql = "UPDATE `tasks` SET `scratch_or_blookly` = ".$bs." WHERE `tasks`.`t_id` =".$t_id;
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "ok";
	}else{
		echo "error";
	}

	
}else if ($showform == "oc") {
	$t_id = $_POST["t_id"];
	$oc = $_POST["oc"];
	$sql = "UPDATE `tasks` SET `t_open_close` = ".$oc." WHERE `tasks`.`t_id` =".$t_id;
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "ok";
		
	}else{
		echo "error";
	}

	
}

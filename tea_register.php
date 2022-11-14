<?php
session_start();
include("inc/conn.php");
include("inc/func.php");
//這個只是要檢查註冊紐按下時是否有重複或奇怪字元
if(isset($_GET["ch"])){
    $check_acc = $_GET["checkacc"];
    check($conn,$check_acc);
    exit;

}

//todo: 確定Ok了就在這裡處理老師的相關資料



// $_SESSION["name"];
// $_SESSION["account"];
// $_SESSION["password"];
// $_SESSION["email"];
// $_SESSION["area"];
// $_SESSION["level"];
// $_SESSION["school"];
// print_r($_POST);
$_SESSION["u_name"]=$_POST["name"];
$_SESSION["account"]=$_POST["account"];
$_SESSION["password"]=$_POST["password"];
$_SESSION["email"]=$_POST["email"];
// $_SESSION["level"]=$_POST["level"];
// $_SESSION["school_id"]=$_POST["school"];
$_SESSION["u_level"]="1";
//users表建立一個帳號
$sql ="select * from users";
$result = mysqli_query($conn,$sql);
$users_num = mysqli_num_rows($result);

$sql = "INSERT INTO `users` (`uid`, `u_acc`, `u_psd`, `u_name`, `u_info`, `u_level`) 
VALUES ('".$users_num."',
         '".$_POST["account"]."', 
         '".$_POST["password"]."', 
         '".$_POST["name"]."', 
         '', 
         '1')";
$result = mysqli_query($conn,$sql);

//建立教師資料表

$sql ="select * from teachers";
$result = mysqli_query($conn,$sql);
$users_num = mysqli_num_rows($result);

$sql = "INSERT INTO `users` (`uid`, `u_acc`, `u_psd`, `u_name`, `u_info`, `u_level`) 
VALUES ('".$users_num."',
         '".$_POST["account"]."', 
         '".$_POST["password"]."', 
         '".$_POST["name"]."', 
         '', 
         '1')";
$result = mysqli_query($conn,$sql);





header("Location:login_ok.php");

?>
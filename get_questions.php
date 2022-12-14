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
    if($_SESSION["td_id"]!=""){
        echo "ok";
    }
}




?>
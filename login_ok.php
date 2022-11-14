<?php
include('inc/header.php');
/*把$_SESSION的鍵變成變數*/
extract($_SESSION);
if (!isset($u_level)) { 
	//未登入返回index
    header("Location:index.php");
}

//$_SESSION內容
//[call_main]***** [name]
//           ***** [id] 
//[dist_cd]  ***** [basic_dist_cd] 
//[title_cd] ***** [prefix] 

switch(true){ 
	case $u_level==0:
		header("Location:stu.php");
		break;

    case $u_level==1:
        header("Location:tea.php");
        break;
    case $u_level==2:
        header("Location:admin.php");
        break;

	// 其他人員類別
	default:	
		header("Location:index.php");
		break;
}
include('inc/footer.php');
?>
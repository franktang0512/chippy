<?php
include('inc/header.php');
// session_destroy();
extract($_SESSION);
if (!isset($u_level)) { 
	//未登入返回index
    header("Location:index.php");
}
include('tea_.php');
// include('slideshow.php');

    $content = $slide_menu;
    // $content = $slide_menu . $item_content;
	echo $content;

include('inc/footer.php');
?>
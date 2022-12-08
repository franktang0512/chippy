<?php


echo "
<nav class='navbar navbar-bg py-1'>
<div class='container'>
    <div class='d-flex flex-wrap justify-content-left'>
        <a class='navbar-brand' href='./index.php'>
            <img src='./img/logo-small.png' style='width:5%;'>
            Chippy 挑戰賽 2.0
        </a>
    </div>";


if (isset($_SESSION["u_name"])) {


        echo"
             <div class='d-flex flex-wrap justify-content-right'>
                <ul class='nav navbar-nav'>
                    <li><a href='' style='color:white'>你好！".$_SESSION["u_name"]."</a></li> 
                </ul> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <ul class='nav navbar-nav'>
                    <li><a href='./logout.php' style='color:white'>登出</a></li>
                </ul>
            </div>
            </div>";

}
echo "</nav>";


?>

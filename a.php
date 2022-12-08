<?php
header("Content-Type:text/html;charset=utf-8");
session_start();
include("inc/func.php");
include("inc/conn.php");
// include("inc/func.php");

// echo $_POST["account"]."------------";
if (isset($_POST["account"])) {
    echo "<div style='margin-top:200px; margin-right:auto; margin-left:auto; width:500px;'>";
    if ($_POST["account"] == "ADMIN" && $_POST["password"] == "viplabadmin") {
        $_SESSION["u_level"] = 2;
        $_SESSION["u_name"] = "ADMIN";
        header("Location:login_ok.php");
    } else {

        if (isset($_POST["account"]) && isset($_POST["password"])) {


            $acc = $_POST["account"];
            $_SESSION["account"] = $_POST["account"];
            $pPass = $_POST["password"];

            if (!Verify_ID($acc) || !Verify_Password($pPass)) {
                echo "帳號和密碼格式有誤<br>";
                // echo $errmsg . "<br><br>";
                echo "<a href=\"login.php\">回上一頁</a>&nbsp;&nbsp;&nbsp;";
                echo "<a href=\"\" target=\"_blank\">密碼查詢</a>";
                echo "</div>";
                exit;
            } else {
                //todo:資料庫撈出帳號的密碼，相等的話在session寫入相關資料與代入權限相關的頁面，不等於的話一樣是錯誤畫面
                $sql = "SELECT u_psd,u_level,u_name,u_id FROM users WHERE u_acc= '$acc'";

                $result = mysqli_query($conn, $sql);
                $numOfrow = mysqli_num_rows($result);
                if ($numOfrow <= 0) {
                    echo "查無此人<br>";
                    // echo $errmsg . "<br><br>";
                    echo "<a href=\"login.php\">回上一頁</a>&nbsp;&nbsp;&nbsp;";
                    echo "<a href=\"\" target=\"_blank\">密碼查詢</a>";
                    echo "</div>";
                    exit;
                } else {
                    //寫一個pg的程式
                    $row = mysqli_fetch_array($result);
                    if ($row[0] == $pPass) {
                        $_SESSION["u_level"] = $row[1];
                        $_SESSION["u_name"] = $row[2];
                        $_SESSION["u_id"] = $row[3];
                        header("Location:login_ok.php");
                    } else {
                        echo "帳號密碼錯誤<br>";
                        // echo $errmsg . "<br><br>";
                        echo "<a href=\"login.php\">回上一頁</a>&nbsp;&nbsp;&nbsp;";
                        echo "<a href=\"\" target=\"_blank\">密碼查詢</a>";
                        echo "</div>";
                        exit;
                    }
                }
            }
        }
    }
} else if (isset($_POST["teacheraccount"]) && isset($_POST["classname"]) && isset($_POST["studentnum"])) {
    $_SESSION["u_level"] = "0";
    
    $_SESSION["u_name"] = "student";

    header("Location:login_ok.php");
    //學生身分
    // echo 'nono';
}

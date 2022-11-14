<?php
header("Content-Type:text/html;charset=utf-8");
session_start();
include("inc/func.php");
include("inc/conn.php");
// include("inc/func.php");
echo "<div style='margin-top:200px; margin-right:auto; margin-left:auto; width:500px;'>";
if ($_POST["account"] == "ADMIN" && $_POST["password"] == "viplabadmin") {
    // $_SESSION["name"] = "管理者";
    // $_SESSION["id"] = $_POST["id"];
    // $_SESSION["dist_cd"] = "X";
    // $_SESSION["basic_dist_cd"] = $_POST["id"]; // 後續menu.php會使用到
    // $_SESSION["title_cd"] = "X";
    // $_SESSION["prefix"] = "同仁您好";

    // $_SESSION["id"] = "管理者";
    // $_SESSION["id"] = $_POST["id"];

    header("Location:login_ok.php");
} else {


    $pID = $_POST["account"];
    $pPass = $_POST["password"];

    //防止SQL injection,先驗證帳號密碼--1011027
    // Verify_ID($pID);
    // Verify_Password($pPass);
    // echo $acc."------".$psd;
    if (!Verify_ID($pID) || !Verify_Password($pPass)) {
        echo "帳號和密碼格式有誤<br>";
        // echo $errmsg . "<br><br>";
        echo "<a href=\"login.php\">回上一頁</a>&nbsp;&nbsp;&nbsp;";
        echo "<a href=\"\" target=\"_blank\">密碼查詢</a>";
        echo "</div>";
        exit;
    } else {
        //todo:資料庫撈出帳號的密碼，相等的話在session寫入相關資料與代入權限相關的頁面，不等於的話一樣是錯誤畫面
        $sql = "SELECT u_psd,u_level,u_name FROM users WHERE u_acc= '$pID'";

        $result = mysqli_query($conn,$sql);
        $numOfrow = mysqli_num_rows($result);
        if ($numOfrow <= 0) {
            echo "查無此人<br>";
            // echo $errmsg . "<br><br>";
            echo "<a href=\"login.php\">回上一頁</a>&nbsp;&nbsp;&nbsp;";
            echo "<a href=\"\" target=\"_blank\">密碼查詢</a>";
            echo "</div>";
            exit;
        }else{
            //寫一個pg的程式
            $row = mysqli_fetch_array($result);
            if($row[0]==$pPass){
                $_SESSION["u_level"] = $row[1];
                $_SESSION["u_name"] = $row[2];
                header("Location:login_ok.php");

            }else{
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

// 錯誤訊息顯示
//echo "您所輸入的帳號為：<font color=red>".$_POST["id"]."</font><br><br>";
//echo "您所輸入的密碼為：<font color=red>".$_POST["pass"]."</font><br><br>";

//header("Refresh: 1; url=index.php");

////////  檢查 ID 是否正確: 只含大寫英文和數字
// function Verify_ID($pID)
// {
//     if (preg_match("/^[a-zA-Z0-9]{10}/", $pID))  return true;
//     else {
//         $acc = 1;

//         echo "帳號必須為10碼英數字!<br>";
//         //header("Refresh: 1; url=index.php");			
//         // die("帳號必須為10碼英數字!");

//     }
// }
// /////////  檢查密碼是否正確: 只含大小寫英文和數字以及部分的特殊字元!@$^_-
// function Verify_Password($pPass)
// {
//     // if (preg_match("/^[a-zA-Z0-9!@\$\^_-]{5,15}$/", $pPass))  return true;
//     if (preg_match("/^[a-zA-Z0-9!@\$\^_-]/", $pPass))  return true;
//     else {
//         $psd = 1;

//         echo "密碼必須5-15碼英數字及部分的特殊字元!@$^_-<br><br>";
//         //header("Refresh: 1;url=index.php");
//         // die("");
//     }
// }
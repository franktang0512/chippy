<?php

include('inc/header.php');

extract($_SESSION);
if (isset($u_level)) {
    //未登入返回index
    header("Location:index.php");
}
?>




<section>
    <div class="pane pane-teacher mt-3">
        <div class="text-center pl-4 py-3 tada">
            <h3>
                <i class="fas fa-chalkboard-teacher fa-fw mr-2" style="font-size: 32px;"></i>教師註冊
            </h3>
        </div>
        <div id="teacherRg" class="pane-registered">
            <form id="registerform" action="tea_register.php" class="form-registered" method="post">
                <div class="form-group row">
                    <div class="col-md-2"><label>姓名*</label></div>
                    <div class="col-md-10"><input type="text" name="name" class="form-control" placeholder="請輸入您的真實姓名" value="" maxlength="10" autofocus="" required=""></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"><label>使用者帳號*</label></div>
                    <div class="col-md-10">
                        <input id="acc" type="text" name="account" class="form-control" placeholder="帳號僅接受5-15個英文字母或數字" maxlength="15" autofocus="" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"><label>密碼*</label></div>
                    <div class="col-md-10"><input type="password" name="password" class="form-control" placeholder="請輸入密碼" value="" maxlength="15" autofocus="" required=""></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"><label>確認密碼*</label></div>
                    <div class="col-md-10"><input type="password" name="password2" class="form-control" placeholder="請重複輸入您剛剛所設定的密碼" value="" maxlength="15" autofocus="" required=""></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"><label>e-mail*</label></div>
                    <div class="col-md-10"><input type="email" name="email" class="form-control" placeholder="請輸入e-mail；學習評量相關重要通知用，請務必填寫正確" value="" required=""></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-lg-2"><label>學校*</label></div>
                    <div class="col-md-2 col-lg-2">
                        <select id="district" name="area" class="select-length" onchange="get_school_list();">
                            <option value="-" disabled="" selected="">--請選擇縣市--</option>
                            <option value="新北市">新北市</option>
                            <option value="臺北市">臺北市</option>
                            <option value="桃園市">桃園市</option>
                            <option value="臺中市">臺中市</option>
                            <option value="臺南市">臺南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="雲林縣">雲林縣</option>
                            <option value="嘉義縣">嘉義縣</option>
                            <option value="屏東縣">屏東縣</option>
                            <option value="臺東縣">臺東縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="澎湖縣">澎湖縣</option>
                            <option value="基隆市">基隆市</option>
                            <option value="新竹市">新竹市</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="金門縣">金門縣</option>
                            <option value="連江縣">連江縣</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <select id="school_level" name="level" class="select-length" onchange="get_school_list();">
                            <option value="-" disabled="" selected="">--請選擇學校類型--</option>
                            <option value="國民小學">國民小學</option>
                            <option value="國民中學">國民中學</option>
                            <option value="高級中學">高級中學</option>
                            <option value="大專院校">大專院校</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <select id="school" name="school" class="select-length">
                            <option value="" disabled="" selected="">--請選擇學校--</option>
                        </select></div>
                </div>
                <div class="row d-flex flex-wrap justify-content-center mt-5">
                    <div class="col-12 col-xs-6 col-md-6 col-lg-3 mb-3"><button class="btn btn-block btn-outline-dark btn-lg" type="reset"> 重填</button></div>
                    <div class="col-12 col-xs-6 col-md-6 col-lg-3 mb-3"><button class="btn btn-block btn-primary btn-lg" type="submit" onclick="return check_acc_exist();">註冊</button></div>
                </div>
            </form>
        </div>
    </div>
</section>


<script>
    function check_acc_exist() {
        const acc = document.getElementById("acc");
        const xmlhttp = new XMLHttpRequest();
        const url = "http://localhost/chippy/tea_register.php?ch=ch&checkacc=" + acc.value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.trim() != "") {
                    let response = this.responseText;
                    if (response != "") {
                        alert(response);
                        history.go(0);
                    }
                }
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    function get_school_list() {

        const district = document.getElementById("district");
        const level = document.getElementById("school_level");
        // console.log(district);
        // console.log(level);
        // console.log(district.options[district.selectedIndex].text);
        // console.log(level.options[level.selectedIndex].text);
        const d =district.options[district.selectedIndex].text;
        const l =level.options[level.selectedIndex].text;
        if ( d!= "--請選擇縣市--" &&  l!= "--請選擇學校類型--") {

            const xmlhttp = new XMLHttpRequest();
            const url = "http://localhost/chippy/getschoollist.php?sch=sch&pro=" + d + "&level=" + l;
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() != "") {

                        let response = this.responseText;
                        if (response != "") {
                            // alert(response);


                            document. getElementById ( "school" ). innerHTML = response;

                        }


                    }
                }
            };
            xmlhttp.open("post", url, true);
            xmlhttp.send();

        }
    }
</script>


<?php
include('inc/footer.php');
?>
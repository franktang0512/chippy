<?php
include('inc/header.php');

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

// include('inc/footer.php');
?>
<section>
    <div class="" id="contents">
        <div class="container justify-content-center text-center workspace mt-2">
            <i class="fas fa-users mr-2" style="font-size: 32px;"></i>
            <h3>班級資訊</h3>
            <p>已註冊之班級及參與級別</p>
            <div class="row">
                <div class="col classlists">
                    <div class="row py-4">
                        <div class="col header">班級名稱</div>
                        <div class="col header">年級</div>
                        <div class="col header">參與級別</div>
                    </div>

                    
                    <div class="row py-2">
                        <div class="col">
                            <input
                                type="button"
                                class="btn classnamebtn"
                                onclick="showClassInfo('班級一_','11','P3');showStudents('班級一_','11');"
                                value="班級一_"
                            >
                        </div>
                        <div class="col">11</div>
                        <div class="col">問題導向挑戰</div>
                    </div>
                </div>
                <div class="col studentlists">
                    <div id="classinfo"></div>
                    <div id="studentnamelist"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include('inc/footer.php');
?>
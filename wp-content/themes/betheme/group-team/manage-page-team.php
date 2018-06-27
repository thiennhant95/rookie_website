<?php
/*
 Template Name: Quản lý thông tin nhóm
 */
 ?>
 <?php 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$explode = explode("/",$url_path);
	$team_slug = $explode[1];
	global $wpdb;
	$table_team = $wpdb->prefix."team";
	$data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE slug = %s",$team_slug);
	$data_team = $wpdb->get_row($data_prepare);
	$search = array("\r\n","&lt;br&gt;","\&quot;","\&amp;","\&#039;","\\\\");
	$replace = array("<br>","<br>","&quot;","&amp;","&#039","\\");
	if($data_team != null){
?>
<?php get_header(); ?>
<style>
    .mycolor{
        color : #20bcf6;
    }
    .myborder{
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: 0px 0px 3px 0px #20bcf6;
        -moz-box-shadow:    0px 0px 3px 0px #20bcf6;
        box-shadow:         0px 0px 3px 0px #20bcf6;
    }
    .mybutton{
        position: relative;
        left: 50%;
        top: 193px;

    }
    .margin-bottom-20 {
        margin-bottom: 20px;

    }
    input, select, textarea{
        color: #252525!important;
        font-size: 14px!important;
        font-family:inherit!important;
    }
    .btn-u:hover {
        background: #20bcf6;
    }
    .btn-u:hover, .btn-u:focus, .btn-u:active, .btn-u.active, .open .dropdown-toggle.btn-u {
        background: #20bcf6;
    }
    .btn-u:hover {
        color: #fff;
        text-decoration: none;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    .btn-u {
        background: #0b97c4;
    }
    .btn-u {
        white-space: nowrap;
        border: 0;
        color: #fff;
        font-size: 17px;
        cursor: pointer;
        font-weight: 400;
        padding: 9px 13px;
        position: relative;
        background: #0b97c4;
        display: inline-block;
        text-decoration: none;
    }
    .input-group-addon {
        border-right: 0;
        /*color: #b3b3b3;*/
        font-size: 14px;
        background: #fff;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .input-group .form-control {
        float: left;
        width: 100%;
        margin-bottom: 0;
    }
    .form-control {
        box-shadow: none;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px !important;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid  #1e83c9 !important;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
    .submit:hover{
        background-color: #1e83c9;
    }
    #imageUpload-label:hover{
        background-position: 0;
    }
    .title-group{
        color: #252525;
        font-weight: bold;
        font-size: 15px;
    }
</style>
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="container">
            <div class="col-md-2">
            	<ul class="nav nav-pills nav-stacked">
				  <li class="active"><a href="#">Quản Lý</a></li>
				  <li class="menu-tab active" data-id="menu1"><a>Thông tin nhóm</a></li>
				  <li class="menu-tab" data-id="menu2"><a>Đổi mật khẩu</a></li>
				  <li class="menu-tab" data-id="menu3"><a>Sản phẩm nhóm</a></li>
				  <li class="menu-tab" data-id="menu4"><a>Đơn đặt hàng</a></li>
				</ul>
            </div>
            <div class="col-md-8">
                <div class="row myborder">
                    <form method="post" id="register-form" action="" class="form-manage" data-id="menu1" style="display:block">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                        <input required size="60" maxlength="255"  class="form-control" placeholder="Tên Nhóm" name="ten_nhom" id="UserRegistration_username" type="text">
                    </div>
                        <div class="input-group" style="margin-bottom: 10px; text-align: left">
                            <input type="file" name="imageUpload" id="imageUpload" class="hide"/>
                            <label for="imageUpload" class="btn btn-large btn-primary btn-flat" id="imageUpload-label" style="background-color: #20bcf6"><span class="glyphicon glyphicon-picture" style="margin-right: 15px"></span>Logo</label>
                            <span id="imagePreview" style="margin-left: 25px"></span>
                        </div>
                        <hr>
                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN TRƯỞNG NHÓM</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="lead_username" id="lead_username" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Email(Email đăng nhập)" name="lead_email" id="lead_email" type="email">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="lead_school" id="lead_school" type="text">
                        </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                        <input required size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="lead_phone" id="lead_phone" type="text">
                    </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="lead_birthday" id="lead_birthday" type="text">
                        </div>
                        <hr/>

                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 1</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u1_username" id="u1_username" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Email" name="u1_email" id="u1_email" type="email">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u1_school" id="lead_school" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u1_phone" id="u1_phone" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u1_birthday" id="u1_birthday" type="text">
                        </div>
                        <hr/>

                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 2</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u2_username" id="u2_username" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Email" name="u2_email" id="u2_email" type="email">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u2_school" id="u2_school" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u2_phone" id="u2_phone" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u2_birthday" id="u2_birthday" type="text">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-u btn-block pull-left submit" type="submit" name="dangky">Đăng Ký</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" id="register-form1" class="form-manage" action="" data-id="menu2" style="display:none">
                    	<div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required size="60" maxlength="255" minlength="6" class="form-control" placeholder="Mật khẩu cũ ( ít nhất 6 ký tự)" name="password" id="UserRegistration_oldpassword" type="password">
                        </div>
                    	<div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required size="60" maxlength="255" minlength="6" class="form-control" placeholder="Mật khẩu( ít nhất 6 ký tự)" name="password" id="UserRegistration_password" type="password">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required size="60" maxlength="255" minlength="6"  class="form-control" placeholder="Xác nhận mật khẩu" name="password_confirm" id="UserRegistration_password_confirm " type="password">
                        </div>
                    </form>
                    <form method="post" id="register-form2" class="form-manage" action="" data-id="menu3" style="display:none">
                    </form>
                    <form method="post" id="register-form3" class="form-manage" action="" data-id="menu4" style="display:none">
                    </form>
                </div>
                <div class="col-md-8" id="menu2">

            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function($){
    	$(".menu-tab").click(function(){
    		$(".menu-tab").removeClass("active");
			$(this).addClass('active');
			var data = $(this).attr('data-id');
			if(data == "menu1")
			{
				$(".form-manage").css({"display":"none"});
				$("#register-form").css({"display":"block"});
			}
			if(data == "menu2")
			{
				$(".form-manage").css({"display":"none"});
				$("#register-form1").css({"display":"block"});
			}
			if(data == "menu3")
			{
				$(".form-manage").css({"display":"none"});
				$("#register-form2").css({"display":"block"});
			}
			if(data == "menu4")
			{
				$(".form-manage").css({"display":"none"});
				$("#register-form3").css({"display":"block"});
			}
		});
	});
</script>
<?php get_footer(); ?>
<?php } 
else{
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );
}
?>
<?php
/*
 Template Name: Quản lý thông tin nhóm
 */
 ?>
 <?php
    ob_start();
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$explode = explode("/",$url_path);
    $group_team_slug = $explode[0];
	$team_slug = $explode[1];
	global $wpdb;
	$table_team = $wpdb->prefix."team";
	$data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE slug = %s",$team_slug);
	$data_team = $wpdb->get_row($data_prepare);
	$search = array("\r\n","&lt;br&gt;","\&quot;","\&amp;","\&#039;","\\\\");
	$replace = array("<br>","<br>","&quot;","&amp;","&#039","\\");
	if($data_team != null && $group_team_slug == "manage-group"){
        if(isset($_SESSION["branch_id"]) && isset($_SESSION["branch_slug"])){ 
            if($_SESSION["branch_slug"] == $team_slug){
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

    label{ cursor: pointer; }

    #upload-photo, #upload-background, #upload-feature {
       opacity: 0;
       z-index: -1;
    }

    .avatar, #background{
        overflow: hidden;
    }
    #background .textbox{ padding: 10px 0px; top: 0; }
    .avatar .textbox, #background .textbox{ transition: all 0.35s ease-in; }
    .avatar:hover .textbox{margin-top: -48px; }
    #background .textbox{margin-top: -48px; }
    #background:hover .textbox{margin-top: 0px; z-index:9999;}
    .checkbox-products{ width: 20px; height: 20px;  filter: invert(150%) hue-rotate(50deg) brightness(1.9); }
    .font-size{ font-size: 16px }
    @media only screen and (max-width: 500px){
       .font-size, .shop-items .item .item-dtls .price{ font-size: 12px !important}
       .shop-items .item img{ height: 70px !important; }
       .shop-items { padding: 0; }
       .myborder{ padding: 5px; }
    }
    @media only screen and (min-width: 501px) and (max-width: 600px){
        .shop-items .item img{ height: 100px !important; }
        .font-size, .shop-items .item .item-dtls .price{ font-size: 13px !important}
        .shop-items { padding: 0; }
       .myborder{ padding: 5px; }
    }
     @media only screen and (min-width: 601px) and (max-width: 800px){
        .shop-items .item img{ height: 160px !important; }
        .font-size, .shop-items .item .item-dtls .price{ font-size: 15px !important}
        .shop-items { padding: 0; }
       .myborder{ padding: 5px; }
    }
    .table-responsive table { display: inline-table; }
</style>
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="container">
            <div class="col-md-12" style="margin-bottom: 50px; padding-right: 0">
                <div class="col-md-12" style="position: relative; padding: 0">
                    <form name="photo" id="imagebackgroundForm" enctype="multipart/form-data" method="post">
                    <div class="col-md-12" style="background-color:#000; background-image: url('<?php echo $data_team->background; ?>'); background-position: center center; background-repeat: no-repeat; background-size: cover; overflow: hidden; height: 250px; padding: 0px" id="background">
                        <input type="file" name="upload-background" id="upload-background" style="display: none">
                        <label for="upload-background">
                            <div class="textbox" style="position: absolute; background-color: #000000; opacity: 0.6; color: #ffffff; width: 220px; ">
                                <span class="glyphicon glyphicon-camera" style="padding: 0 10px;"></span><span>Upload Background</span>
                            </div>
                        </label>
                    </div>
                    <div style="right: 0; top:0; position: absolute;"><button type="submit" class="btn btn-primary" style="width: 120px; border-radius: 5px; display: none" id="save-background">Cập nhật</button></div>
                    </form>
                    <form name="photo" id="imageUploadForm" enctype="multipart/form-data" method="post">
                    <div class="col-md-2 col-xs-4 col-sm-4 avatar" style="position: absolute; background-color: #fff; left: 5%; bottom:0; height: 120px; padding:0; width:120px; border: 3px solid #ffffff">
                        <?php  ?>
                            <span id="load-avatar"><img src="<?php echo $data_team->logo ?>" style="height: 120px !important; width: 120px !important"></span>
                        <?php  ?>
                        <label for="upload-photo"><div class="textbox" style="position: absolute; background-color: #000000; opacity: 0.6; color: #ffffff; width: 120px; ">
                            <span class="glyphicon glyphicon-camera" style="padding: 10px"></span><span>Upload</span>
                        </div></label>
                        <input type="file" name="upload-photo" id="upload-photo" style="display: none">
                    </div>
                    <div class="col-md-8 col-xs-6 col-sm-6" style="position: absolute; right:10%; bottom: 2%; color: #000; text-shadow: 1px 2px 0 #fff, 2px 1px 0 #fff, -1px 2px 0 #fff, -2px 1px 0 #fff, 1px -2px 0 #fff, 2px -1px 0 #fff, -1px -2px 0 #fff, -2px -1px 0 #fff">
                        <h3 style="color: #000"><strong><a href="<?php echo home_url().'/group-team/'.$data_team->slug ?>" target="_blank"><?php echo $data_team->ten_nhom ?></a></strong></h3>
                    </div>
                    <div class="clearfix"></div>
                    <div style="margin-left: 5%; position: absolute;"><button type="submit" class="btn btn-primary" style="width: 120px; border-radius: 5px; display:none" id="save-upload">Cập nhật</button></div>
                    </form>
                </div>
            </div>
            <?php 
                if(isset($_SESSION["success_change"])){
            ?>
            <div class="col-md-12">
                <?php
                    if($_SESSION["success_change"] == 1){
                        ?>
                        <div class="alert alert-success">
                            Cập nhật mật khẩu thành công
                        </div>
                        <?php
                        $_SESSION["success_change"] = 0; 
                    }
                    if($_SESSION["success_change"] == 2){
                        ?>
                        <div class="alert alert-danger">
                            Cập nhật mật khẩu thất bại
                        </div>
                        <?php
                        $_SESSION["success_change"] = 0; 
                    }
                    if($_SESSION["success_change"] == 3){
                        ?>
                        <div class="alert alert-danger">
                            Mật khẩu nhập lại không khớp
                        </div>
                        <?php
                        $_SESSION["success_change"] = 0; 
                    }
                    if($_SESSION["success_change"] == 4){
                        ?>
                        <div class="alert alert-danger">
                            Mật khẩu cũ không đúng
                        </div>
                        <?php
                        $_SESSION["success_change"] = 0; 
                    }
                ?>    
            </div>
            <?php } ?>
            <div class="clearfix"></div>
            <?php 
            if(isset($_SESSION["success_change_info"])){
            ?>
            <div class="col-md-12">
                <?php
                    if($_SESSION["success_change_info"] == 1){
                        ?>
                        <div class="alert alert-success">
                            Cập nhật thông tin thành công
                        </div>
                        <?php
                        $_SESSION["success_change_info"] = 0; 
                    }
                    if($_SESSION["success_change_info"] == 2){
                        ?>
                        <div class="alert alert-danger">
                            Cập nhật thông tin thất bại
                        </div>
                        <?php
                        $_SESSION["success_change_info"] = 0; 
                    }
                ?>
            </div>
            <?php } ?>
            <?php 
            if(isset($_SESSION["success_description"])){
            ?>
            <div class="col-md-12">
                <?php
                    if($_SESSION["success_description"] == 1){
                        ?>
                        <div class="alert alert-success">
                            Cập nhật thông tin thành công
                        </div>
                        <?php
                        $_SESSION["success_description"] = 0; 
                    }
                    if($_SESSION["success_description"] == 2){
                        ?>
                        <div class="alert alert-danger">
                            Cập nhật thông tin thất bại
                        </div>
                        <?php
                        $_SESSION["success_description"] = 0; 
                    }
                ?>
            </div>
            <?php } ?>
             <?php 
            if(isset($_SESSION["success_post"])){
            ?>
            <div class="col-md-12">
                <?php
                    if($_SESSION["success_post"] == 1){
                        ?>
                        <div class="alert alert-success">
                            Đăng bài viết thành công
                        </div>
                        <?php
                        $_SESSION["success_post"] = 0; 
                    }
                    if($_SESSION["success_post"] == 2){
                        ?>
                        <div class="alert alert-danger">
                            Đăng bài viết thất bại
                        </div>
                        <?php
                        $_SESSION["success_post"] = 0; 
                    }
                    if($_SESSION["success_post"] == 3){
                        ?>
                        <div class="alert alert-danger">
                            Không được để rỗng thông tin bài viết
                        </div>
                        <?php
                        $_SESSION["success_post"] = 0; 
                    }
                ?>
            </div>
            <?php } ?>
            <div class="col-md-12" style="display:none" id="notice-upload-avatar"></div>
            <div class="clearfix"></div>
            <div class="col-md-2" style="margin-bottom: 30px">
            	<ul class="nav nav-pills nav-stacked">
				  <li class="active"><a href="#">Quản Lý</a></li>
				  <li class="menu-tab active" data-id="menu1"><a>Thông tin nhóm</a></li>
                  <li class="menu-tab" data-id="menu5"><a>Thông tin trang</a></li>
				  <li class="menu-tab" data-id="menu2"><a>Đổi mật khẩu</a></li>
				  <li class="menu-tab" data-id="menu3"><a>Sản phẩm nhóm</a></li>
				  <li class="menu-tab" data-id="menu4"><a>Đơn đặt hàng</a></li>
                  <li class="menu-tab" data-id="menu8"><a>Doanh thu</a></li>
                  <li class="menu-tab" data-id="menu6"><a>Bài viết</a></li>
                  <li class="menu-tab" data-id="menu7"><a>Tạo bài viết</a></li>
                  <li class="menu-tab"><a href="<?php echo home_url('dang-xuat') ?>">Đăng xuất</a></li>
				</ul>
            </div>
            <div class="col-md-10" style="margin-bottom: 30px">
                <div class="row myborder">
                    <form method="post" id="register-form" action="<?php echo home_url("change-information-group") ?>" class="form-manage" data-id="menu1" style="display:block">
                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN TRƯỞNG NHÓM</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="lead_username" id="lead_username" type="text" value="<?php echo $data_team->ten_truong_nhom ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Email(Email đăng nhập)" name="lead_email" id="lead_email" type="email" value="<?php echo $data_team->email_truong_nhom ?>" disabled="disabled">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="lead_school" id="lead_school" type="text" value="<?php echo $data_team->truong_truong_nhom ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="lead_phone" id="lead_phone" type="text" value="<?php echo $data_team->sdt_truong_nhom ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="lead_birthday" id="lead_birthday" type="text" value="<?php echo $data_team->namsinh_truong_nhom ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Facebook trưởng nhóm" name="facebook_truong_nhom" id="facebook_captain" type="text" value="<?php echo $data_team->facebook_truong_nhom ?>">
                        </div>
                        <hr/>

                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 1</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u1_username" id="u1_username" type="text" value="<?php echo $data_team->ten_member_1; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Email" name="u1_email" id="u1_email" type="email" value="<?php echo $data_team->email_member_1; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u1_school" id="lead_school" type="text" value="<?php echo $data_team->truong_member_1; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u1_phone" id="u1_phone" type="text" value="<?php echo $data_team->sdt_member_1; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u1_birthday" id="u1_birthday" type="text" value="<?php echo $data_team->namsinh_member_1; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Facebook thành viên 1" name="facebook_u1" id="facebook_captain" type="text" value="<?php echo $data_team->facebook_u1 ?>">
                        </div>
                        <hr/>

                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 2</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u2_username" id="u2_username" type="text" value="<?php echo $data_team->ten_member_2; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Email" name="u2_email" id="u2_email" type="email" value="<?php echo $data_team->email_member_2; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u2_school" id="u2_school" type="text" value="<?php echo $data_team->truong_member_2; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u2_phone" id="u2_phone" type="text" value="<?php echo $data_team->sdt_member_2; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u2_birthday" id="u2_birthday" type="text" value="<?php echo $data_team->namsinh_member_2; ?>">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required size="60" maxlength="255" class="form-control" placeholder="Facebook thành viên 2" name="facebook_u2" id="facebook_captain" type="text" value="<?php echo $data_team->facebook_u2 ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-u btn-block pull-left submit" type="submit" name="capnhat">Cập Nhật</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" id="register-form1" class="form-manage" action="<?php echo home_url("change-password") ?>" data-id="menu2" style="display:none">
                    	<div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required size="60" maxlength="255" minlength="6" class="form-control" placeholder="Mật khẩu cũ ( ít nhất 6 ký tự)" name="oldpassword" id="UserRegistration_oldpassword" type="password">
                        </div>
                    	<div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required size="60" maxlength="255" minlength="6" class="form-control" placeholder="Mật khẩu( ít nhất 6 ký tự)" name="newpassword" id="UserRegistration_password" type="password">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required size="60" maxlength="255" minlength="6"  class="form-control" placeholder="Xác nhận mật khẩu" name="newpassword_confirm" id="UserRegistration_password_confirm " type="password">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-u btn-block pull-left submit" type="submit" name="xacnhan">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" id="register-form2" class="form-manage" action="" data-id="menu3" style="display:none">
                        <?php 
                            $table_products = $wpdb->prefix."products";
                            $query_products = "SELECT * FROM $table_products";
                            $data_products = $wpdb->get_results($query_products);
                            $arr_team_product = json_decode($data_team->san_pham_nhom);
                            $count_arr_team_product = count($arr_team_product);
                        ?>
                        <div class="shop-items">
                            <div class="container-fluid">
                                <div class="row">
                                <?php
                                $count_foreach_product = 0;
                                $images_url = home_url()."/wp-content/uploads/image-product/";
                                foreach ($data_products as $row):
                                    $arr_image_products =json_decode($row->product_images);
                                    if($count_foreach_product % 3 == 0){
                                    ?>
                                    <div class="clearfix"></div>
                                    <?php
                                    }
                                    $count_foreach_product++;
                                    ?>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <!-- Restaurant Item -->
                                        <div class="item">
                                            <?php if(!empty($arr_team_product)){ ?>
                                                <?php if(!in_array($row->id,$arr_team_product)){ ?>
                                                    <input type="checkbox" class="checkbox-products" name="san_pham_nhom" value="<?php echo $row->id; ?>" <?php if($count_arr_team_product >= 10){ echo "disabled"; } ?>>
                                                <?php } 
                                                    else{
                                                ?>
                                                    <input type="checkbox" class="checkbox-products checked-product" name="san_pham_nhom" value="<?php echo $row->id; ?>" checked="checked">
                                                <?php
                                                    }
                                                ?>
                                            <?php }else{
                                                ?>
                                                 <input type="checkbox" class="checkbox-products" name="san_pham_nhom" value="<?php echo $row->id; ?>" <?php if($count_arr_team_product >= 10){ echo "disabled"; } ?>>
                                                <?php
                                            } ?>
                                            <!-- Item's image -->
                                            <img class="img-responsive" src="<?php echo $images_url.$arr_image_products[0] ?>" alt="">
                                            <!-- Item details -->
                                            <div class="item-dtls">
                                                <!-- product title -->
                                                <span class="font-size"><a href="<?php echo home_url()."/".$row->product_slug ?>"><?php echo $row->product_name ?></a></span>
                                                <!-- price -->
                                                <span class="price lblue"><?php echo number_format($row->product_price)."đ" ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                                </div>
                            </div>
                            <button class="btn-primary btn-block pull-left submit" type="submit" name="xacnhan" id="submit_product">Xác nhận</button>
                            <span class="col-md-12" id="notice-products" style="margin-top: 15px"></span>
                        </div>
                    </form>
                    <form method="post" id="register-form3" class="form-manage" action="" data-id="menu4" style="display:none">
                        <div class="btn btn-default col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-6 col-xs-6 col-sm-6"><strong>Họ Tên</strong></div>
                            <div class="col-md-6 col-xs-6 col-sm-6"><strong>Trạng Thái</strong></div>
                        </div>
                        <?php 
                            $table_order = $wpdb->prefix."order";
                            $query_order = $wpdb->prepare("SELECT * FROM $table_order WHERE team_id = %d ORDER BY $table_order.id",$data_team->id);
                            $data_order = $wpdb->get_results($query_order);
                            foreach($data_order as $order){
                        ?>
                        <div class="btn btn-info col-md-12 col-sm-12 col-xs-12 text-center" data-toggle="collapse" data-target="#order<?php echo $order->id ?>">
                            <div class="col-md-6 col-xs-6 col-sm-6"><?php echo $order->order_name; ?></div>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <strong>
                                <?php 
                                if($order->order_status == 0){
                                    echo "Chưa xử lý";
                                } 
                                else if($order->order_status == 1){
                                    echo "Thành công";
                                } 
                                else if($order->order_status == 2){
                                    echo "Đang giao";
                                } 
                                else if($order->order_status == 3){
                                    echo "Huỷ đơn hàng";
                                } 
                                else if($order->order_status == 4){
                                    echo "Trả về";
                                } 
                                ?>
                                </strong>
                            </div>
                        </div>
                        <div id="order<?php echo $order->id ?>" class="collapse">
                            <table class="table table-bordered table-condensed table-responsive table-striped table-hover">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><strong>Email : </strong><a href="mailto:<?php echo $order->order_email ?>"><?php echo $order->order_email ?></a></p>
                                    <p><strong>Số điện thoại :</strong><a href="tel:<?php echo $order->order_phone ?>"> <?php echo $order->order_phone ?></a></p>
                                </div>
                                <caption><h3>Chi Tiết Đơn Đặt Hàng</h3></caption>
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng</th>
                                        <th>Đơn Giá</th>
                                        <th>Tổng Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $table_order_detail = $wpdb->prefix."order_detail";
                                        $table_products = $wpdb->prefix."products";
                                        $query_order_detail = $wpdb->prepare("SELECT * FROM $table_order_detail WHERE order_id = %d AND team_id = %d",$order->id,$order->team_id);
                                        $data_order_detail = $wpdb->get_results($query_order_detail);
                                        foreach($data_order_detail as $order_detail){
                                            $query_product = $wpdb->prepare("SELECT * FROM $table_products WHERE id = %d",$order_detail->product_id);
                                            $product = $wpdb->get_row($query_product);
                                    ?>
                                    <tr>
                                        <td><?php echo $product->product_name ?></td>
                                        <td><?php echo $order_detail->amount ?></td>
                                        <td><?php echo $order_detail->price ?></td>
                                        <td><?php echo $order_detail->detail_total_price ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <td colspan="4" class="text-right" style="padding-right: 15px"><strong>Tổng tiền : <?php echo $order->total_price ?></strong></td>
                                    </tr>
                                    <?php if($order->order_status == 0){ ?>
                                    <tr>
                                        <td colspan="4"><button type="submit" class="btn btn-success" name="btn-success" style="margin-right: 15px">Xác nhận</button><button type="submit" class="btn btn-danger" name="btn-cancel">Huỷ đơn hàng</button></td>
                                    </tr>
                                    <?php } ?>
                                </tfoot>
                                
                            </table>
                        </div>
                        <?php
                            }
                        ?>
                    </form>
                    <form method="post" id="register-form4" class="form-manage" action="<?php echo home_url("change-description-group") ?>" data-id="menu5" style="display:none">
                        <div class="margin-bottom-20">
                            <span><strong>Slogan :</strong></span>
                            <?php
                                remove_action( 'media_buttons', 'media_buttons' ); 
                                $content_slogan = str_replace('\"', '"', $data_team->slogan);
                                $editor_slogan = 'slogan_group';
                                $settings =   array(
                                    'wpautop' => true,
                                    'media_buttons' => false,
                                    'textarea_name' => $editor_slogan,
                                    'textarea_rows' => get_option('default_post_edit_rows', 7),
                                    'quicktags' => true
                                );
                                wp_editor( $content_slogan, $editor_slogan, $settings = array() ); 
                                
                            ?>
                        </div>
                        <hr>
                        <div class="margin-bottom-20">
                            <span><strong>Mô tả :</strong></span>
                            <?php 
                                $content_description = str_replace('\"', '"', $data_team->mo_ta);
                                $editor_description = 'description_group';
                                $settings =   array(
                                    'wpautop' => true,
                                    'media_buttons' => false,
                                    'textarea_name' => $editor_description,
                                    'textarea_rows' => get_option('default_post_edit_rows', 7),
                                    'quicktags' => true
                                );
                                wp_editor( $content_description, $editor_description, $settings = array() ); 
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-u btn-block pull-left submit" type="submit" name="capnhat">Cập Nhật</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" id="register-form5" class="form-manage" action="" data-id="menu6" style="display:none">
                        <?php 
                            $table_post_group = $wpdb->prefix."post_group";
                            $table_team_post = $wpdb->prefix."team_post";
                            $query_prepare_post_group = $wpdb->prepare("SELECT * FROM $table_post_group INNER JOIN $table_team_post ON $table_post_group.id = $table_team_post.id_post WHERE id_team = %d",$_SESSION["branch_id"]);
                            $data_post_group = $wpdb->get_results($query_prepare_post_group);
                        ?>
                        <table id="your-list-post" class="table table-responsive table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ảnh đại diện</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung tóm tắt</th>
                                    <th>Trạng thái</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if(!empty($data_post_group)){ 
                                foreach($data_post_group as $post_group){
                            ?>
                                <tr>
                                    <td><img src="<?php echo $post_group->post_group_feature ?>" style="width: 100px !important"></td>
                                    <td><?php echo $post_group->post_group_title ?></td>
                                    <td><?php echo $post_group->post_group_content?></td>
                                    <td><?php echo $post_group->post_group_status ?></td>
                                    <td><a href="<?php echo home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug; ?>"><?php echo home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug; ?></a></td>
                                </tr>
                            <?php 
                                } 
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                    <form method="post" id="register-form6" class="form-manage" action="<?php echo home_url('post-group-team'); ?>" data-id="menu7" style="display:none" enctype="multipart/form-data">
                        <div class="margin-bottom-20">
                            <span><strong>Tiêu đề :</strong></span>
                            <input type="" maxlength="255" class="form-control" placeholder="Tiêu đề" name="post_title">
                        </div>
                        <div class="margin-bottom-20">
                            <span><strong>Nội dung :</strong></span>
                            <?php 
                                $content_post = "";
                                $editor_post = 'description_post';
                                $settings =   array(
                                    'wpautop' => true,
                                    'media_buttons' => false,
                                    'textarea_name' => $editor_post,
                                    'textarea_rows' => get_option('default_post_edit_rows', 7),
                                    'quicktags' => true
                                );
                                wp_editor( $content_post, $editor_post, $settings = array() ); 
                            ?>
                        </div>
                        <div class="margin-bottom-20">
                            <span><strong>Ảnh đại diện :</strong></span>
                            <input type="file" name="upload-feature" id="upload-feature" style="display: none">
                            <label for="upload-feature">
                                <span class="btn btn-primary">Upload</span>
                            </label>
                            <p id="load-feature"></p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-u btn-block pull-left submit" type="submit" name="dangbai">Đăng bài</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" id="register-form7" class="form-manage" data-id="menu8" style="display:none">
                        <h3><strong>Doanh Thu :</strong></h3>
                        <div class="col-md-12">
                        <table class="table table-responsive table-hover table-condensed table-striped table-bordered">
                            <?php 
                                $table_statistical = "statistical";
                                $query_statistical = $wpdb->prepare("SELECT $table_statistical.*, $table_team.ten_nhom FROM $table_statistical INNER JOIN $table_team ON $table_statistical.team_id = $table_team.id WHERE $table_statistical.team_id = %d",$data_team->id);
                                $statistical = $wpdb->get_row($query_statistical);
                            ?>
                            <tbody>
                                <tr>
                                    <td><strong>Tổng doanh thu :</strong></td>
                                    <td colspan="3"><?php echo number_format($statistical->sum_no_ship)."đ"; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Đơn hàng thành công :</strong></td>
                                    <td><?php echo $statistical->count_success; ?></td>
                                    <td><strong>Đơn hành huỷ :</strong></td>
                                    <td><?php echo $statistical->count_cancel; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Sản phẩm</strong></td>
                                    <td colspan="2"><strong>Tổng tiền</strong></td>
                                </tr>
                                <?php
                                   $query_order_detail = $wpdb->prepare("SELECT * FROM $table_order_detail WHERE status = 1 AND team_id = %d GROUP BY product_id",$data_team->id);
                                   $data_order_detail = $wpdb->get_results($query_order_detail);
                                   foreach($data_order_detail as $order_detail){
                                    $query_product = $wpdb->prepare("SELECT * FROM $table_products WHERE id = %d",$order_detail->product_id);
                                    $product = $wpdb->get_row($query_product);
                                    $data_query_detail = $wpdb->prepare("SELECT SUM(detail_total_price) as total_renueve FROM $table_order_detail WHERE status = 1 AND product_id = %d AND team_id = %d",$order_detail->product_id,$data_team->team_id);
                                    $product_detail = $wpdb->get_row($data_query_detail);
                                ?>
                                <tr>
                                    <td colspan="2"><?php echo $product->product_name ?></td>
                                    <td colspan="2"><?php echo number_format($product_detail->total_renueve)."đ" ?></td>
                                </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function($){
        $(".checkbox-products").change(function(){
            if($(this).hasClass('checked-product'))
            {
                $(this).removeClass("checked-product");   
            }
            else
            {
                 $(this).addClass("checked-product");
            }
            var checked_product = $(".checked-product");
            if(checked_product.length >= 10)
            {
                $(".checkbox-products").each(function(number, index ) {
                   if(!$(index).hasClass('checked-product')){
                        $(index).attr("disabled","disabled");
                   }
                })
            }
            else
            {
                $(".checkbox-products").each(function(number, index ) {
                    $(index).removeAttr("disabled");
                })
            }
        })
        $('#register-form2').on('submit',(function(e) {
            e.preventDefault();
            var url = '<?php echo home_url()."/xu-ly-dang-ky-san-pham" ?>';
            var arr_product = new Array();
            var id_team = <?php echo $_SESSION['branch_id']; ?>;
            $("#submit_product").attr("disabled","disabled");
            $(".checkbox-products").each(function(number, index ) {
               if($(index).hasClass('checked-product')){
                   arr_product.push($(index).val());
               }
            })
            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',                
                data: { product: arr_product, id_team : id_team },
                success: function( data, textStatus, jQxhr ){
                    if(data == 1){
                        $("#notice-products").html('<div class="col-md-12 alert alert-success">Cập nhật sản phẩm nhóm thành công</div>');
                    }
                    else{
                        $("#notice-products").html('<div class="col-md-12 alert alert-danger">Cập nhật sản phẩm nhóm thất bại</div>');
                    }
                    $("#submit_product").removeAttr("disabled");        
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });    
        }));

    });    

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
            if(data == "menu5")
            {
                $(".form-manage").css({"display":"none"});
                $("#register-form4").css({"display":"block"});
            }
            if(data == "menu6")
            {
                $(".form-manage").css({"display":"none"});
                $("#register-form5").css({"display":"block"});
            }
            if(data == "menu7")
            {
                $(".form-manage").css({"display":"none"});
                $("#register-form6").css({"display":"block"});
            }
            if(data == "menu8")
            {
                $(".form-manage").css({"display":"none"});
                $("#register-form7").css({"display":"block"});
            }
		});
	});
    jQuery.extend(jQuery.validator.messages, {
        required: "Đây là trường bắt buộc nhập.",
        minlength: jQuery.validator.format("Vui lòng nhập từ {0} kí tự trở lên."),
        email: "Vui lòng nhập đúng định dạng email.",
        number: "Vui lòng nhập đúng định dạng số.",
        date:" Vui lòng chọn đúng định dạng ngày."
    });
    jQuery(document).ready(function($) {
        $("#u2_birthday").datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            changeYear: true,
            // yearRange: "1980:2000",
            monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
            monthNamesShort: ["1","2","3","4","5","6","7","8","9","10","11","12"]
        });
    });

    jQuery(document).ready(function($) {
        $("#u1_birthday").datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            changeYear: true,
            // yearRange: "1980:2000",
            monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
            monthNamesShort: ["1","2","3","4","5","6","7","8","9","10","11","12"]
        });
    });

    jQuery(document).ready(function($) {
        $("#lead_birthday").datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            changeYear: true,
            // yearRange: "1980:2000",
            monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
            monthNamesShort: ["1","2","3","4","5","6","7","8","9","10","11","12"]
        });
    });


    jQuery(document).ready(function($) {
        $("#your-list-post").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "pageLength"  : 10
        });
        $.validator.addMethod("noSpace", function(value, element) {
            return value == '' || value.trim().length != 0;
        }, "Vui lòng không nhập khoảng trắng.");

        $("#register-form").validate({
            rules: {
                lead_username:{required:true,noSpace:true},
                u1_username:{required:true,noSpace:true},
                u2_username:{required:true,noSpace:true},
                lead_email:{required:true,email: true},
                u1_email:{required:true,email: true},
                u2_email:{required:true,email: true},
                lead_school:{required:true,noSpace:true},
                u1_school:{required:true,noSpace:true},
                u2_school:{required:true,noSpace:true},
                lead_phone:{required:true,number: true,minlength:10},
                u1_phone:{required:true,number: true,minlength:10},
                u2_phone:{required:true,number: true,minlength:10},
                lead_birthday:{required:true,date: true},
                u1_birthday:{required:true,date: true},
                u2_birthday:{required:true,date: true}
            },
        });
        $('#lead_birthday').datepicker({
        }).on('change', function() {
            $(this).valid();
        });

        $('#u1_birthday').datepicker({
        }).on('change', function() {
            $(this).valid();
        });
        $('#u2_birthday').datepicker({
        }).on('change', function() {
            $(this).valid();
        });
        $("#register-form1").validate({
            rules: {
                newpassword : {
                    required:true,
                    minlength : 6,
                    noSpace:true
                },
                newpassword_confirm : {
                    required:true,
                    minlength : 6,
                    equalTo : "#UserRegistration_password",
                    noSpace:true
                },
            },
            messages: {
                newpassword_confirm: {equalTo:"Mật khẩu xác nhận không giống với mật khẩu trên."},
            }
        });
        $("#upload-photo").on('change', function () {
            var load_avatar = $("#load-avatar");
            if (typeof (FileReader) != "undefined") {
                load_avatar.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "width": "120px",
                        "height":"120px"
                    }).appendTo(load_avatar);
                }
                load_avatar.show();
                reader.readAsDataURL($(this)[0].files[0]);
            }
            $("#save-upload").css({"display":"block"});
        });
         $('#imageUploadForm').on('submit',(function(e) {
            e.preventDefault();
            var image = $("#upload-photo")[0].files[0];
            var formData = new FormData();
            var url = '<?php echo home_url()."/upload-avatar-group" ?>';
            formData.append('avatar_group', image);
            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function( data, textStatus, jQxhr ){
                    $("#notice-upload-avatar").html(data);
                    $("#notice-upload-avatar").css({"display":"block"});
                    $("#save-upload").css({"display":"none"});
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });    
        }));

        $("#upload-background").on('change', function () {
            var load_background = $("#background");
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#background').css({'background-image':'url(' + e.target.result + ')'});
                    $('#background').appendTo(load_background);
                }
                load_background.show();
                reader.readAsDataURL($(this)[0].files[0]);
            }
            $("#save-background").css({"display":"block"});
        });
        $('#imagebackgroundForm').on('submit',(function(e) {
            e.preventDefault();
            var background = $("#upload-background")[0].files[0];
            var formData = new FormData();
            var url = '<?php echo home_url()."/upload-avatar-group" ?>';
            formData.append('background_group', background);
            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function( data, textStatus, jQxhr ){
                    $("#notice-upload-avatar").html(data);
                    $("#notice-upload-avatar").css({"display":"block"});
                    $("#save-background").css({"display":"none"});
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });    
        }));
        $("#upload-feature").on('change', function () {
            var load_feature = $("#load-feature");
            if (typeof (FileReader) != "undefined") {
                load_feature.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "width": "120px",
                        "height":"120px"
                    }).appendTo(load_feature);
                }
                load_feature.show();
                reader.readAsDataURL($(this)[0].files[0]);
            }
        });
    });
</script>
<?php get_footer(); ?>
<?php 
        } 
        else{
            global $wp_query;
            $wp_query->set_404();
            status_header( 404 );
            get_template_part( 404 );
        }
    }
    else{
        $url = home_url("dang-nhap");
        wp_redirect($url);
    }
} 
else{
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );
}
?>
<?php
/**
 * Template Name: register
 **/
get_header();
?>
<style>
    .mycolor{
        color : #20bcf6;
    }
    .myborder{
        padding: 20px;;
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
    .error{
        color: #d53239!important;
    }
</style>
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="container">
            <?php
            if (!isset($_SESSION['xacnhan']) || $_SESSION['xacnhan']==0):
            ?>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row myborder">
                    <?php
                    if (isset($_SESSION['thongbaoloi']) && $_SESSION['thongbaoloi']=='1'):
                    ?>
                    <div class="alert alert-danger alert-autocloseable-danger">
                       Quá trình đăng kí không thành công. Vui lòng đăng ký lại.
                    </div>
                    <?php
                        $_SESSION['thongbaoloi']='0';
                    endif;
                    if (isset($_SESSION['thongbaoloi']) && $_SESSION['thongbaoloi']=='2'):
                        ?>
                        <div class="alert alert-danger alert-autocloseable-danger">
                            Email trưởng nhóm của bạn đã được đăng ký. Vui lòng đăng ký bằng một email khác.
                        </div>
                        <?php
                        $_SESSION['thongbaoloi']='0';
                    endif;
                    if (isset($_SESSION['thongbaoloi']) && $_SESSION['thongbaoloi']=='3'):
                        ?>
                        <div class="alert alert-danger alert-autocloseable-danger">
                            Email thành viên 1 của bạn đã được đăng ký. Vui lòng đăng ký bằng một email khác.
                        </div>
                        <?php
                        $_SESSION['thongbaoloi']='0';
                    endif;
                    if (isset($_SESSION['thongbaoloi']) && $_SESSION['thongbaoloi']=='4'):
                        ?>
                        <div class="alert alert-danger alert-autocloseable-danger">
                            Email thành viên 2 của bạn đã được đăng ký. Vui lòng đăng ký bằng một email khác.
                        </div>
                        <?php
                        $_SESSION['thongbaoloi']='0';
                    endif;
                    if (isset($_SESSION['thongbaoloi']) && $_SESSION['thongbaoloi']=='5'):
                        ?>
                        <div class="alert alert-danger alert-autocloseable-danger">
                            Các email đăng ký giữa các thành viên không được giống nhau. Vui lòng nhập email khác nhau.
                        </div>
                        <?php
                        $_SESSION['thongbaoloi']='0';
                    endif;
                    if (isset($_SESSION['thongbaoloi']) && $_SESSION['thongbaoloi']=='6'):
                        ?>
                        <div class="alert alert-danger alert-autocloseable-danger">
                            Các số điện đăng ký giữa các thành viên không được giống nhau. Vui lòng nhập số điện thoại khác nhau.
                        </div>
                        <?php
                        $_SESSION['thongbaoloi']='0';
                    endif;
                    ?>
                    <form method="post" id="register-form" action="<?php echo home_url('xu-ly')?>" enctype="multipart/form-data">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                        <input required  size="60" maxlength="255"  class="form-control" placeholder="Tên Nhóm" name="ten_nhom" id="UserRegistration_username" type="text">
                    </div>

                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required  size="60" maxlength="255" minlength="6" class="form-control" placeholder="Mật khẩu( ít nhất 6 ký tự)" name="password" id="password" type="password">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock mycolor"></i></span>
                            <input required  size="60" maxlength="255" minlength="6"  class="form-control" placeholder="Xác nhận mật khẩu" name="password_confirm" id="password_confirm " type="password">
                        </div>
                        <hr>
                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN TRƯỞNG NHÓM</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="lead_username" id="lead_username" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Email(Email đăng nhập)" name="lead_email" id="lead_email" type="email">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input  size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="lead_school" id="lead_school" type="text">
                        </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                        <input required  size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="lead_phone" id="lead_phone" type="text">
                    </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="lead_birthday" id="lead_birthday" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-facebook-square mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder=" Link Facebook" name="lead_facebook" id="lead_facebook" type="text">
                        </div>
                        <hr/>

                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 1</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u1_username" id="u1_username" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Email" name="u1_email" id="u1_email" type="email">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u1_school" id="u1_school" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u1_phone" id="u1_phone" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u1_birthday" id="u1_birthday" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-facebook-square mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder=" Link Facebook" name="u1_facebook" id="u1_facebook" type="text">
                        </div>
                        <hr/>

                        <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 2</span>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u2_username" id="u2_username" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Email" name="u2_email" id="u2_email" type="email">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u2_school" id="u2_school" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u2_phone" id="u2_phone" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u2_birthday" id="u2_birthday" type="text">
                        </div>
                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-facebook-square mycolor"></i></span>
                            <input required  size="60" maxlength="255" class="form-control" placeholder=" Link Facebook" name="u2_facebook" id="u2_facebook" type="text">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-u btn-block pull-left submit" type="submit" name="dangky">Đăng Ký</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <?php
        elseif (isset($_SESSION['xacnhan']) && $_SESSION['xacnhan']==1):
        ?>
        <div class="col-md-12 well well-lg message-xacnhan text-center"><h4>Bạn đã đăng ký tài khoản thành công. Chúng tôi đã gửi cho bạn mail xác nhận tài khoản. <br/>Vui lòng bạn kiểm tra mail để xác nhận tài khoản đăng ký.</h4></div>
        <?php
            $_SESSION['xacnhan']=0;
        endif;
        ?>
    </div>
</div>
<br>
<br>
<?php
get_footer();
?>
<script>
    jQuery.extend(jQuery.validator.messages, {
        required: "Đây là thông tin bắt buộc nhập.",
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
        $.validator.addMethod("noSpace", function(value, element) {
            return value == '' || value.trim().length != 0;
        }, "Vui lòng không nhập khoảng trắng.");

        $("#register-form").validate({
            rules: {
                ten_nhom: {required:true,noSpace:true},
                password : {
                    required:true,
                    minlength : 6,
                    noSpace:true
                },
                password_confirm : {
                    required:true,
                    minlength : 6,
                    equalTo : "#password",
                    noSpace:true
                },
                lead_username:{required:true,noSpace:true},
                u1_username:{required:true,noSpace:true},
                u2_username:{required:true,noSpace:true},
                lead_email:{required:true,email: true},
                u1_email:{required:true,email: true},
                u2_email:{required:true,email: true},
                lead_school:{required:true,noSpace:true},
                u1_school:{required:true,noSpace:true},
                u2_school:{required:true,noSpace:true},
                lead_phone:{required:true,number: true,minlength:10,maxlength:12},
                u1_phone:{required:true,number: true,minlength:10,maxlength:12},
                u2_phone:{required:true,number: true,minlength:10,maxlength:12},
                lead_birthday:{required:true,date: true},
                u1_birthday:{required:true,date: true},
                u2_birthday:{required:true,date: true}
                lead_facebook:{required:true}
                u1_facebook:{required:true}
                u2_facebook:{required:true}
            },
            messages: {
                password_confirm: {equalTo:"Mật khẩu xác nhận không giống với mật khẩu trên."},
            }
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
    });
</script>


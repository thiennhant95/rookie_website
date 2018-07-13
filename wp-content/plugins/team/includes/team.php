<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 07/04/2018
 * Time: 2:56 PM
 */
function team_view_function()
{
    global $wpdb;
    $table_products = $wpdb->prefix."team";
    $data = "SELECT * FROM $table_products";
    $product_list =$wpdb->get_results($data);
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css">
    <div <?php if (isset($_GET['add_team'])==1) echo "style='display:none'"?> class="content-wrapper">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản Lý Nhóm</h3>
                <p>
                    <?php
                    if (isset($_SESSION['themsp']) && $_SESSION['themsp']=='1'):
                    ?>
                <div class="alert alert-success alert-autocloseable-danger">
                    Thêm mới sản phẩm thành công.
                </div>
                <?php
                $_SESSION['themsp']='0';
                endif;
                ?>
                <?php
                if (isset($_SESSION['suasp']) && $_SESSION['suasp']=='1'):
                    ?>
                    <div class="alert alert-success alert-autocloseable-danger">
                        Sửa mới sản phẩm thành công.
                    </div>
                    <?php
                    $_SESSION['suasp']='0';
                endif;
                if (isset($_SESSION['suasp']) && $_SESSION['suasp']=='3'):
                    ?>
                    <div class="alert alert-danger alert-autocloseable-danger">
                        Xóa sản phẩm thành công.
                    </div>
                    <?php
                    $_SESSION['suasp']='0';
                endif;
                ?>
                </p>
                <!--            <br/>-->
                <h3 class="box-title" style="float: right"><a class="btn btn-primary btn-flat" href="../wp-admin/admin.php?page=team_view&add_team=1">Thêm Nhóm Mới</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="team-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên nhóm</th>
                        <th>Email nhóm trưởng</th>
                        <th>Trường</th>
                        <th>Số điện thoại</th>
                        <th>Trạng Thái</th>
                        <th>Điểm Mini Game</th>
                        <th>Chức Năng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach ($product_list as $row)
                    {
                        ?>
                        <tr>
                            <td><?php echo $row->id?></td>
                            <td><a href="<?php echo home_url('group-team/'.$row->slug)?>" target="_blank"><?php echo $row->ten_nhom ?></a></td>
                            <td><?php echo $row->email_truong_nhom?></td>
                            <td><?php echo $row->truong_truong_nhom?></td>
                            <td><?php echo $row->sdt_truong_nhom ?></td>
                            <td id="status<?php echo $row->id ?>"><?php echo $row->team_status==1?'<span class="badge bg-green">Đang hoạt động</span>':'<span class="badge bg-red">Bị khóa</span>'?></td>
                            <td><form method="post" id="mini-game"><input team-id="<?php echo $row->id ?>" id="mini-game-<?php echo $i?>" type="number" style="width: 50%" name="mini_game" value="<?php  echo $row->diem ?>">&nbsp;<a href="<?php echo home_url('mini-game') ?>" data-id="<?php echo $i?>" class="btn btn-warning update-mini"><span class="glyphicon glyphicon-check"></span></a> <span class="mini-status-<?php echo $i?>"></span></form></td>
                            <td>
                                <input type="submit" name="lock" href="<?php echo home_url('admin-team?lock-team=1&id='.$row->id) ?>" class="btn <?php
                                if($row->team_status==1)
                                    echo "btn-primary";
                                else
                                    echo "btn-danger";
                                ?> delete"  data-id= "<?php echo $row->id ?>" id='lock<?php echo $row->id ?>' value="<?php if ($row->team_status==1) {
                                    echo "Khóa";
                                }
                                else
                                {
                                    echo "Mở Khóa";
                                } ?>">
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <style>
        #product-table td
        {
            vertical-align:middle;
        }
        .bg-green{
            background-color: #5cb85c;
        }
        .bg-red{
            background-color: #d53239;
        }
    </style>

    <script>
        $('.popovers').click(function (e) {
            e.preventDefault();
        });
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
        $(document).ready(function(){
            $("#team-table").DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "pageLength"  : 10
            });
        });

        $(document).ready(function(){
            $("#team-table").on("click", ".delete", function(event){
                var href = $(this).attr("href");
                var id   = '#' + $(this).attr("id");
                var status ='#status' + $(this).attr("data-id");
                var btn = this;
                $.ajax({
                    type: "GET",
                    url: href,
                    dataType : "json"
                })
                    .done(function(data){
                        $(id).val(data.status);
                        if (data.status == 'Mở Khóa') {
                            $(id).removeClass( "btn-primary" ).addClass( "btn-danger" );
                            $(status).html('');
                            $(status).html('<span class="badge bg-red">Không hoạt động</span>');
                        }
                        else
                        {
                            $(id).removeClass( "btn-danger" ).addClass( "btn-primary" );
                            $(status).html('');
                            $(status).html('<span class="badge bg-green">Đang hoạt động</span>');
                        }
                    })
            })
        });
        $("#team-table").on("click", ".update-mini", function(event){
            event.preventDefault();
            var href = $(this).attr("href");
            var id = $(this).attr("data-id");
            var diem =$('#mini-game-'+id).val();
            var team_id =$('#mini-game-'+id).attr("team-id");
            $.ajax({
                type: "POST",
                url: href,
                dataType : "json",
                data:{team_id:team_id,diem:diem}
            })
                .done(function(data){
                    if (data.status==1)
                    {
                        $(".mini-status-"+id).addClass('glyphicon glyphicon-ok');
                        setTimeout(function () {
                            $(".mini-status-"+id).removeClass('glyphicon glyphicon-ok');
                        }, 3000);
                    }
                    else
                    {
                        $(".mini-status-"+id).addClass('glyphicon glyphicon-remove');
                        setTimeout(function () {
                            $(".mini-status-"+id).removeClass('glyphicon glyphicon-remove');
                        }, 3000);
                    }
                })

        })


    </script>
    <?php
    if(isset($_GET['add_team'])==1) {
        ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
            .error{
                color: #d53239!important;
            }
        </style>
        <div id="Content">
            <h3>Thêm nhóm</h3>
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
                            <form method="post" id="register-form" action="<?php echo home_url('xu-ly-admin')?>" enctype="multipart/form-data">
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255"  class="form-control" placeholder="Tên Nhóm" name="ten_nhom" id="UserRegistration_username" type="text">
                                </div>

                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" minlength="6" class="form-control" placeholder="Mật khẩu( ít nhất 6 ký tự)" name="password" id="password" type="password">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" minlength="6"  class="form-control" placeholder="Xác nhận mật khẩu" name="password_confirm" id="password_confirm " type="password">
                                </div>
                                <hr>
                                <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN TRƯỞNG NHÓM</span>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="lead_username" id="lead_username" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Email(Email đăng nhập)" name="lead_email" id="lead_email" type="email">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input  size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="lead_school" id="lead_school" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="lead_phone" id="lead_phone" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="lead_birthday" id="lead_birthday" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder=" Link Facebook" name="lead_facebook" id="lead_facebook" type="text">
                                </div>
                                <hr/>

                                <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 1</span>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u1_username" id="u1_username" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Email" name="u1_email" id="u1_email" type="email">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u1_school" id="u1_school" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u1_phone" id="u1_phone" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u1_birthday" id="u1_birthday" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder=" Link Facebook" name="u1_facebook" id="u1_facebook" type="text">
                                </div>
                                <hr/>

                                <span class="title-group"><i class="glyphicon glyphicon-user"></i> THÔNG TIN THÀNH VIÊN 2</span>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Họ tên" name="u2_username" id="u2_username" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Email" name="u2_email" id="u2_email" type="email">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Tên Trường" name="u2_school" id="u2_school" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Số điện thoại" name="u2_phone" id="u2_phone" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder="Ngày tháng năm sinh" name="u2_birthday" id="u2_birthday" type="text">
                                </div>
                                <br/>
                                <div class="input-group margin-bottom-20">
                                    <span class="input-group-addon"></span>
                                    <input required  size="60" maxlength="255" class="form-control" placeholder=" Link Facebook" name="u2_facebook" id="u2_facebook" type="text">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block submit" type="submit" name="dangky">Đăng Ký</button>
                                        <a href="<?php echo admin_url('admin.php?page=team_view') ?>" class="btn btn-warning btn-block submit">Trở lại</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <?php
                elseif (isset($_SESSION['xacnhan1']) && $_SESSION['xacnhan1']==1):
                    ?>
                    <div class="col-md-12 well well-lg message-xacnhan text-center"><h4>Bạn đã thêm tài khoản thành công.</h4></div>
                    <a href="<?php echo admin_url('admin.php?page=team_view&add_team=1') ?>" class="btn btn-info btn-block submit">Thêm mới</a>
                    <a href="<?php echo admin_url('admin.php?page=team_view') ?>" class="btn btn-warning btn-block submit">Trở lại</a>
                    <?php
                    $_SESSION['xacnhan']=0;
                endif;
                ?>
            </div>
        </div>
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
                        lead_phone:{required:true,number: true,minlength:10},
                        u1_phone:{required:true,number: true,minlength:10},
                        u2_phone:{required:true,number: true,minlength:10},
                        lead_birthday:{required:true,date: true},
                        u1_birthday:{required:true,date: true},
                        u2_birthday:{required:true,date: true}
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
        <?php
    }
}


?>
<?php
get_header();
?>
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="container">
            <?php
            if (isset($_GET['token']))
            {
                $url =home_url('xac-nhan-tai-khoan/?token='.$_GET['token']);
                $table_team = $wpdb->prefix . "team";
                $data_prepare1 = $wpdb->prepare("SELECT * FROM $table_team WHERE verify_email = %s",$url);
                $data_team1 = $wpdb->get_row($data_prepare1);
                if ($data_team1)
                {
                    $update = $wpdb->update($table_team, array(
                        'team_status'=>1,
                        'verify_email'=>0,
                    ),array('id'=>$data_team1->id)
                    );
                    ?>
            <div class="col-md-12 well well-lg message-xacnhan text-center"><h4>Tài khoản của bạn đã được xác nhận thành công. <br/><a class="btn btn-primary" href="<?php echo home_url('dang-nhap')?>">Đăng nhập</a></h4>
                    <?php
                }
                else
                {
                    ?>
                <div class="col-md-12 well well-lg message-xacnhan text-center"><h4>Tài khoản của bạn không được xác nhận do sai đường dẫn xác nhận hoặc đã được xác nhận trước đó.<br/></h4>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="col-md-12 well well-lg message-xacnhan text-center"><h4>Tài khoản của bạn không được xác nhận do sai đường dẫn xác nhận. <br/></h4>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<style>
    #Subheader{
        display: none;
    }
</style>

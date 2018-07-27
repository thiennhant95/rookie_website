<?php
/**
 * Template Name: Checkout
 **/
get_header();
?>
<style>
    html,body,.wrapper{
        background: #f7f7f7;
    }
    .steps {
        margin-top: -41px;
        display: inline-block;
        float: right;
        font-size: 16px
    }
    .step {
        float: left;
        background: white;
        padding: 7px 13px;
        border-radius: 1px;
        text-align: center;
        width: 100px;
        position: relative
    }
    .step_line {
        margin: 0;
        width: 0;
        height: 0;
        border-left: 16px solid #fff;
        border-top: 16px solid transparent;
        border-bottom: 16px solid transparent;
        z-index: 1008;
        position: absolute;
        left: 99px;
        top: 1px
    }
    .step_line.backline {
        border-left: 20px solid #f7f7f7;
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
        z-index: 1006;
        position: absolute;
        left: 99px;
        top: -3px
    }
    .step_complete {
        background: #357ebd
    }
    .step_complete a.check-bc, .step_complete a.check-bc:hover,.afix-1,.afix-1:hover{
        color: #eee;
    }
    .step_line.step_complete {
        background: 0;
        border-left: 16px solid #357ebd
    }
    .step_thankyou {
        float: left;
        background: white;
        padding: 7px 13px;
        border-radius: 1px;
        text-align: center;
        width: 100px;
    }
    .step.check_step {
        margin-left: 5px;
    }
    .ch_pp {
        text-decoration: underline;
    }
    .ch_pp.sip {
        margin-left: 10px;
    }
    .check-bc,
    .check-bc:hover {
        color: #222;
    }
    .SuccessField {
        border-color: #458845 !important;
        -webkit-box-shadow: 0 0 7px #9acc9a !important;
        -moz-box-shadow: 0 0 7px #9acc9a !important;
        box-shadow: 0 0 7px #9acc9a !important;
        background: #f9f9f9 url(../images/valid.png) no-repeat 98% center !important
    }

    .btn-xs{
        line-height: 28px;
    }

    /*login form*/
    .login-container{
        margin-top:30px ;
    }
    .login-container input[type=submit] {
        width: 100%;
        display: block;
        margin-bottom: 10px;
        position: relative;
    }

    .login-container input[type=text], input[type=password] {
        height: 44px;
        font-size: 16px;
        width: 100%;
        margin-bottom: 10px;
        -webkit-appearance: none;
        background: #fff;
        border: 1px solid #d9d9d9;
        border-top: 1px solid #c0c0c0;
        /* border-radius: 2px; */
        padding: 0 8px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .login-container input[type=text]:hover, input[type=password]:hover {
        border: 1px solid #b9b9b9;
        border-top: 1px solid #a0a0a0;
        -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    }

    .login-container-submit {
        /* border: 1px solid #3079ed; */
        border: 0px;
        color: #fff;
        text-shadow: 0 1px rgba(0,0,0,0.1);
        background-color: #357ebd;/*#4d90fe;*/
        padding: 17px 0px;
        font-family: roboto;
        font-size: 14px;
        /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
    }

    .login-container-submit:hover {
        /* border: 1px solid #2f5bb7; */
        border: 0px;
        text-shadow: 0 1px rgba(0,0,0,0.3);
        background-color: #357ae8;
        /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
    }

    .login-help{
        font-size: 12px;
    }

    .asterix{
        background:#f9f9f9 url(../images/red_asterisk.png) no-repeat 98% center !important;
    }

    /* images*/
    ol, ul {
        list-style: none;
    }
    .hand {
        cursor: pointer;
        cursor: pointer;
    }
    .cards{
        padding-left:0;
    }
    .cards li {
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
        background-position: 0 0;
        float: left;
        height: 32px;
        margin-right: 8px;
        text-indent: -9999px;
        width: 51px;
    }
    .cards .mastercard {
        background-position: -51px 0;
    }
    .cards li {
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
        background-position: 0 0;
        float: left;
        height: 32px;
        margin-right: 8px;
        text-indent: -9999px;
        width: 51px;
    }
    .cards .amex {
        background-position: -102px 0;
    }
    .cards li {
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
        background-position: 0 0;
        float: left;
        height: 32px;
        margin-right: 8px;
        text-indent: -9999px;
        width: 51px;
    }
    .cards li:last-child {
        margin-right: 0;
    }
    /* images end */



    /*
     * BOOTSTRAP
     */
    .container{
        border: none;
    }
    .panel-footer{
        background:#fff;
    }
    .btn{
        border-radius: 5px;
    }
    .btn-sm, .btn-group-sm > .btn{
        border-radius: 5px;
    }
    .input-sm, .form-horizontal .form-group-sm .form-control{
        border-radius: 5px;
    }

    .panel-info {
        border-color: #999;
    }

    .panel-heading {
        border-top-left-radius: 1px;
        border-top-right-radius: 1px;
    }
    .panel {
        border-radius: 1px;
    }
    .panel-info > .panel-heading {
        color: #ffffff;
        font-weight: 400!important;
        /*border-color: #999;*/
    }
    .panel-info > .panel-heading {
        background-image: linear-gradient(to bottom, #0b97c4 0px, #2d6987 100%);
    }

    hr {
        border-color: #999 -moz-use-text-color -moz-use-text-color;
    }

    .panel-footer {
        border-bottom-left-radius: 1px;
        border-bottom-right-radius: 1px;
        border-top: 1px solid #999;
    }

    .btn-link {
        color: #888;
    }

    hr{
        margin-bottom: 10px;
        margin-top: 10px;
    }

    /** MEDIA QUERIES **/
    @media only screen and (max-width: 989px){
        .span1{
            margin-bottom: 15px;
            clear:both;
        }
    }

    @media only screen and (max-width: 764px){
        .inverse-1{
            float:right;
        }
    }

    @media only screen and (max-width: 586px){
        .cart-titles{
            display:none;
        }
        .panel {
            margin-bottom: 1px;
        }
    }

    .form-control {
        border-radius: 1px;
    }

    @media only screen and (max-width: 486px){
        .col-xss-12{
            width:100%;
        }
        .cart-img-show{
            display: none;
        }
        .btn-submit-fix{
            width:100%;
        }

    }
    input,textarea,select{
        background-color: #fff!important;
        font-family: Helvetica Neue, sans-serif!important;
        color: #0a0a0a!important;
        font-size: 16px!important;
        width: 100% !important;
    }
    input[type=checkbox], input[type=radio]{
        width: auto!important;
    }
    .error{
        color: #d53239!important;
    }
</style>
<?php
$table_products = $wpdb->prefix."products";
$ts_by_url = array();
$sum_weight = 0;
foreach($_SESSION['products'] as $data) {
    if(!array_key_exists($data['id_team'], $ts_by_url))
        $ts_by_url[ $data['id_team'] ] = 0;
    $ts_by_url[ $data['id_team'] ] += $data['price']*$data['qty'];
    $data_detail_product = $wpdb->prepare("SELECT * FROM $table_products WHERE id = %d",$data['id']);
    $result_product = $wpdb->get_row($data_detail_product);
    $sum_weight += $data['qty'] * $result_product->weight;
}
$_SESSION['price_list']=$ts_by_url;
$data = "SELECT * FROM $table_products";
$product_list =$wpdb->get_results($data);
$images_url = home_url()."/wp-content/uploads/image-product/";
?>
<div class="container wrapper">
    <div class="row cart-head">
        <div class="container">
            <div class="row">
                <p></p>
            </div>
            <div class="row">
                <p></p>
            </div>
        </div>
    </div>
    <div class="row cart-body">
            <form class="form-horizontal" id="checkout-form" action="<?php echo home_url('thanhtoan')?>" method="post">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                <!--REVIEW ORDER-->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Sản Phẩm
                    </div>
                    <div class="panel-body">
                        <?php
                        if (isset($_SESSION['products']) || count($_SESSION['products'])>0):
                              foreach ($_SESSION['products'] as $row):
                                        foreach ($product_list as $row_product):
                                            if ($row_product->id==$row['id']):
                                                $arr_image_products =json_decode($row_product->product_images);
                        ?>
                        <div class="form-group">
                            <div class="col-sm-3 col-xs-3">
                                <img class="img-responsive" src="<?php echo $images_url.$arr_image_products[0] ?>" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <div class="col-xs-12"><a href="<?php echo home_url('chi-tiet-san-pham/'.$row_product->product_slug)  ?>"><h4><?php echo $row_product->product_name ?></h4></a></div>
                                <div class="col-xs-12"><small>Số lượng:<span><?php echo $row['qty']?></span></small></div>
                            </div>
                            <div class="col-sm-3 col-xs-3 text-right">
                                <h6><span><?php echo number_format($row['price']*$row['qty']).'đ' ?></span></h6>
                            </div>
                        </div>
                        <div class="form-group"><hr /></div>
                        <?php
                                            endif;
                                        endforeach;
                              endforeach;
                        endif; ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php
                                if (isset($_SESSION['products'])):
                                ?>
                                <strong>Tổng tiền</strong>
                                <div class="pull-right"><span><?php
                                        $sum = 0;
                                        foreach ($_SESSION['products']  as $item) {
                                            $sum += $item['price']*$item['qty'];
                                        }
                                        echo number_format($sum).'đ';
                                        ?></span></div>
                                <?php
                                else:
                                    echo "<span> Chưa có sản phẩm trong giỏ hàng</span>";
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <strong>Tiền Ship</strong>
                                <div class="pull-right">
                                    <span id="shipping">

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <strong>Tổng cộng</strong>
                                <div class="pull-right">
                                    <span id="total_all">
                                        
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--REVIEW ORDER END-->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                <!--SHIPPING METHOD-->
                <div class="panel panel-info">
                    <div class="panel-heading">Địa Chỉ</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <h4>Địa Chỉ Nhận Hàng</h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-lg-12"><strong>Họ Tên:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="order_name" class="form-control" value=""  required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Số điện thoại:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="order_phone" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Email:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="order_mail" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Địa Chỉ:</strong></div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="order_address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $table_tinh = $wpdb->prefix."tinhthanhpho";
                            $data_tinh = "SELECT * FROM $table_tinh";
                            $tinh_list =$wpdb->get_results($data_tinh);
                            ?>
                            <div class="col-md-6 col-xs-12">
                                <strong>Tỉnh/ Thành Phố:</strong>
                                <select class="form-control" name="order_city" id="order_city" required>
                                    <option value="">Chọn Tỉnh/ Thành phố</option>
                                    <?php
                                    foreach ($tinh_list as $row)
                                    {
                                        ?>
                                    <option data-id="<?php echo $row->matp?>" value="<?php echo $row->name?>"><?php echo $row->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="span1"></div>
                            <div class="col-md-6 col-xs-12">
                                <?php
                                $table_huyen = $wpdb->prefix."quanhuyen";
                                $data_huyen = "SELECT * FROM $table_huyen";
                                $huyen_list =$wpdb->get_results($data_huyen);
                                ?>
                                <strong>Quận/ Huyện:</strong>
                                <select class="form-control"  name="order_district" id="order_district" required>
                                    <option value="">Chọn Quận/ Huyện</option>>
                                    <?php
                                    foreach ($huyen_list as $row_huyen)
                                    {
                                        ?>
                                        <option value="<?php echo $row_huyen->name?>" class="car-<?php echo $row_huyen->matp ?> car" attr-quan="<?php echo $row_huyen->maqh; ?>" style="display: none"><?php echo $row_huyen->name ?></option>
                                        <?php
                                    }
//                                    ?>
                                </select>
                                <input type="hidden" name="order_district_id" id="order_district_id">
                                <input type="hidden" name="sum_weight" id="sum_weight" value="<?php echo $sum_weight; ?>">
                                <input type="hidden" name="sum_ship" id="sum_ship">
                            </div>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <div class="col-md-6 col-xs-12">-->
<!--                                --><?php
//                                $table_xa = $wpdb->prefix."xaphuongthitran";
//                                $data_xa = "SELECT * FROM $table_xa";
//                                $xa_list =$wpdb->get_results($data_xa);
//                                ?>
<!--                                <strong>Phường/ Xã:</strong>-->
<!--                                <select class="form-control"  name="order_ward" required>-->
<!--                                    <option>Chọn Phường/ Xã</option>-->
<!--                                    <option>Phường 7</option>-->
<!--                                    --><?php
//                                    foreach ($xa_list as $row_xa)
//                                    {
//                                        ?>
<!--                                        <option value="--><?php //echo $row_xa->name?><!--">--><?php //echo $row_xa->name ?><!--</option>-->
<!--                                        --><?php
//                                    }
//                                    ?>
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-group">
                            <div class="col-md-12"><strong>Ghi chú:</strong></div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="order_content"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12 pull-left">
                           <input type="radio" checked><span><strong> Thanh toán khi nhận hàng</strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary btn-submit-fix btn-lg">Đặt Hàng</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!--SHIPPING METHOD END-->
            </div>
    </div>
    <div class="row cart-footer">
    </div>
</div>
</div>
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
        $.validator.addMethod("noSpace", function(value, element) {
            return value == '' || value.trim().length != 0;
        }, "Vui lòng không nhập khoảng trắng.");

        $("#checkout-form").validate({
            rules: {
                order_name: {required:true,noSpace:true},
                order_phone:{required:true,noSpace:true,number:true},
                order_mail:{required:true,noSpace:true,email:true},
                order_address:{required:true,noSpace:true},
                order_city:{required:true},
                order_district:{required:true},
                // order_ward:{required:true}
            },
            messages: {
            }
        });
    });
    jQuery(document).ready(function($) {
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        $("#order_city").change(function()
        {
            // var car = $(this).attr('data-id');
            var car = $('option:selected', this).attr('data-id');
            console.log(car);
            $(".car").css("display","none");
            $(".car-"+car).css("display","block");
            $("#order_district").val('');
        });
        $("#order_district").change(function(){
            var district = $('option:selected', this).attr('attr-quan');
            $("#order_district_id").val(district);
            var sum_weight = $("#sum_weight").val();
            var url = '<?php echo home_url()."/function-shipping-dhl" ?>';
            $.ajax({
                url: url,
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',                
                data: { district: district, sum_weight : sum_weight },
                success: function( data, textStatus, jQxhr ){
                    $("#sum_ship").val(data);
                    $("#shipping").html(addCommas(data) + "đ");
                    $("#total_all").html(addCommas(parseInt(data) + parseInt(<?php echo $sum; ?>))+"đ");
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        })
    });

</script>

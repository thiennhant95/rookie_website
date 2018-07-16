<?php
get_header();
?>
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="container">
            <div class="col-md-12 well well-lg message-xacnhan text-center"><h4>Bạn đã đặt hàng thành công. Chúng tôi đã gửi mail cho bạn về thông tin của đơn hàng. <br/><p style="color: red">Cảm ơn bạn đã mua hàng tại Rookie!</p></h4>
                <br/>
<!--                <h4>-->
<!--                Mã đơn hàng của bạn là: <span id="order-code">123456 <i class="fa fa-angle-right"></i></span>-->
<!--                </h4>-->
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<style>
    #order-code{
        margin-top: 0.5%;
        background-color: #2ca02c;
        padding: 0.8% 2% 0.8% 2%;
        color: #ffffff;
    }
    .fa-angle-right{
        padding-left: 1%;
    }
    #Subheader{
        display: none;
    }
</style>

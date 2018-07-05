<?php 
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $explode = explode("/",$url_path);
    $product_slug = $explode[1];
    global $wpdb;
    $table_products = $wpdb->prefix."products";
    $data_prepare_products = $wpdb->prepare("SELECT * FROM $table_products WHERE product_slug = %s",$product_slug);
    $data_products = $wpdb->get_row($data_prepare_products);
    if(!empty($data_products)){
?>
<?php
get_header();
?>
<style>
    body{margin-top:20px;
        background:#eee;
    }

    /*panel*/
    .panel {
        border: none;
        box-shadow: none;
    }

    .panel-heading {
        border-color:#eff2f7 ;
        font-size: 16px;
        font-weight: 300;
    }

    .panel-title {
        color: #2A3542;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
        margin-top: 0;
        font-family: 'Open Sans', sans-serif;
    }

    /*product list*/

    .prod-cat li a{
        border-bottom: 1px dashed #d9d9d9;
    }

    .prod-cat li a {
        color: #3b3b3b;
    }

    .prod-cat li ul {
        margin-left: 30px;
    }

    .prod-cat li ul li a{
        border-bottom:none;
    }
    .prod-cat li ul li a:hover,.prod-cat li ul li a:focus, .prod-cat li ul li.active a , .prod-cat li a:hover,.prod-cat li a:focus, .prod-cat li a.active{
        background: none;
        color: #ff7261;
    }

    .pro-lab{
        margin-right: 20px;
        font-weight: normal;
    }

    .pro-sort {
        padding-right: 20px;
        float: left;
    }

    .pro-page-list {
        margin: 5px 0 0 0;
    }

    .product-list img{
        width: 100%;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
    }

    .product-list .pro-img-box {
        position: relative;
    }
    .adtocart {
        background: #fc5959;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        color: #fff;
        display: inline-block;
        text-align: center;
        border: 3px solid #fff;
        left: 45%;
        bottom: -25px;
        position: absolute;
    }

    .adtocart i{
        color: #fff;
        font-size: 25px;
        line-height: 42px;
    }

    .pro-title {
        color: #5A5A5A;
        display: inline-block;
        margin-top: 20px;
        font-size: 16px;
    }

    .product-list .price {
        color:#fc5959 ;
        font-size: 15px;
    }

    .pro-img-details {
        margin-left: -15px;
    }

    .pro-img-details img {
        width: 100%;
    }

    .pro-d-title {
        font-size: 16px;
        margin-top: 0;
    }

    .product_meta {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 10px 0;
        margin: 15px 0;
    }

    .product_meta span {
        display: block;
        margin-bottom: 10px;
    }
    .product_meta a, .pro-price{
        color:#fc5959 ;
    }

    .pro-price, .amount-old {
        font-size: 18px;
        padding: 0 10px;
    }

    .amount-old {
        text-decoration: line-through;
    }

    .quantity {
        width: 120px;
    }

    .pro-img-list img {
        margin: 10px 0 0 -15px;
        width: 90px !important;
        height: auto;
        display: inline-block;
    }

    .pro-img-list a {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .pro-d-head {
        font-size: 18px;
        font-weight: 300;
    }
</style>
<div class="container">
    <div class="row">
<div class="col-md-9">
    <section class="panel">
        <div class="panel-body">
            <div class="col-md-6">
                <?php
                $images_url = home_url()."/wp-content/uploads/image-product/"; 
                $arr_image_product = json_decode($data_products->product_images); 
                if(!empty($arr_image_product))
                {
                    $start = 0;
                    foreach($arr_image_product as $key => $image_product){
                    if($key == $start){
                ?>
                <div class="pro-img-details">
                    <img src="<?php echo $images_url.$image_product ?>" alt="">
                </div>
                <?php 
                    }
                    else{
                ?>
                <div class="pro-img-list">
                    <a href="#">
                        <img src="<?php echo $images_url.$image_product ?>" alt="">
                    </a>
                </div>
                <?php 
                        }
                    }
                }
                ?>
            </div>
            <div class="col-md-6">
                <h2>
                    <strong>
                        <?php echo $data_products->product_name; ?>
                    <strong>
                </h2>
                <p>
                    <?php  echo str_replace($search, $replace,$data_products->product_description); ?>
                </p>
                <div class="m-bot15"> <strong>Price : </strong><span class="pro-price"><?php echo number_format($data_products->product_price)."đ"; ?></span></div>
                <form id="product-<?php echo $i?>" method="post" action="<?php echo home_url('shopping')?>">
                <div class="form-group">
                    <label>Số Lượng</label>
                    <input type="quantiy" placeholder="1" class="form-control quantity" name="product_qty">
                </div>
                <p>
                    <div>
                        <input type="hidden" name="product_id" value="<?php echo $data_products->id; ?>" />
                        <?php
                            $current_url = base64_encode($_SERVER['REQUEST_URI']);
                        ?>
                        <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                        <input type="hidden" name="type" value="add">
                        <button class="btn btn-round btn-danger ecom bg-lblue" type="button" onclick="document.getElementById('product-<?php echo $i?>').submit()" href="/shoping-car/"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</button>
                    </div>                                              
                </p>
                </form>
            </div>
        </div>
        <section>
            <?php echo str_replace($search, $replace, $data_products->product_long_description); ?>
        </section>
    </section>
</div>
    </div>
</div>
<?php
get_footer();
?>
<?php 
    }
    else
    {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        get_template_part( 404 );
    } 
?>
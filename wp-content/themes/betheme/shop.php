<?php
/**
 * Template Name: Shop
 **/
get_header();
?>
<div class="shop-items">
    <div class="container-fluid">
        <div class="row">
            <?php
            $per_page =16;
            if (!isset($_GET['page-sp']) ||$_GET['page-sp']==null || $_GET['page-sp']==0)
            {
                $offset=0;
            }
            else
            {
                $offset=($_GET['page-sp']-1)*16;
            }
            $table_products = $wpdb->prefix."products";
            $data = "SELECT * FROM $table_products  WHERE status=1";
            $product_list =$wpdb->get_results($data);
            $data1 = "SELECT * FROM $table_products  WHERE status=1 LIMIT 16 OFFSET ".$offset;
            $product_list1 =$wpdb->get_results($data1);
            $i=1;
            $images_url = home_url()."/wp-content/uploads/image-product/";
            foreach ($product_list1 as $row)
            {
                $arr_image_products =json_decode($row->product_images)
                ?>
                <form id="product-<?php echo $i?>" method="post" action="<?php echo home_url('shopping')?>">
                <div class="col-md-3 col-sm-6 col-xs-3">
                    <!-- Restaurant Item -->
                    <div class="item">
                            <!-- Item's image -->
                            <img class="img-responsive" src="<?php echo $images_url.$arr_image_products[0] ?>" alt="">
                        <!-- Item details -->
                        <div class="item-dtls">
                            <!-- product title -->
                            <h4><a href="<?php echo home_url()."/chi-tiet-san-pham/".$row->product_slug ?>"><?php echo $row->product_name ?></a></h4>
                            <!-- price -->
                            <span class="price lblue"><?php echo number_format($row->product_price)."đ" ?></span>
                        </div>
                        <!-- add to cart btn -->
                        <div class="ecom bg-lblue">
                            <input type="hidden" name="product_id" value="<?php echo $row->id?>" />
                            <?php
                            $current_url = base64_encode($_SERVER['REQUEST_URI']);
                            ?>
                            <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                            <input type="hidden" name="type" value="add">
                            <a href="javascript:void()" onclick="document.getElementById('product-<?php echo $i?>').submit()" class="btn btn-gio-hang" style="white-space: normal;" href="/shoping-car/"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a>
                        </div>
                    </div>
                </div>
                </form>
                <?php
                $i++;
            }
            ?>
            <?php
            $pages = ceil(count($product_list)/$per_page);
            ?>
        </div>
    </div>
    <?php
    if (count($product_list)>16):
    ?>
    <nav aria-label="Page navigation" id="div1">
        <ul class="pager">
            <li>
                <a href="#" aria-label="Quay lại">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <?php
            for ($i=1;$i <= $pages;$i++):
                ?>
                <li id="<?php echo $i;?>"><a <?php if ($_GET['page-sp']==$i) echo 'style="background-color: #dfdfdf;"';?> href="<?php echo home_url('san-pham')?>?page-sp=<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php
            endfor;
            ?>
            <li>
                <a href="#" aria-label="Tiếp theo">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
        <?php
    endif;
        ?>
</div>
<?php
get_footer();
?>
<style>
    @media only screen and (max-width: 500px){
        .col-xs-3{
            padding: 3px;
        }
        .font-size, .shop-items .item .item-dtls .price,.item-dtls > h4 > a { font-size: 8px !important}
        .shop-items .item img{ height: 70px !important; }
        .shop-items { padding: 0; }
        .myborder{ padding: 5px; }
    }
    @media only screen and (min-width: 501px) and (max-width: 600px){
        .col-xs-3{
            padding: 3px;
        }
        .shop-items .item img{ height: 100px !important; }
        .font-size, .shop-items .item .item-dtls .price,.item-dtls > h4 > a{ font-size: 12px !important}
        .shop-items { padding: 0; }
        .myborder{ padding: 5px; }
    }
    @media only screen and (min-width: 601px) and (max-width: 800px){
        .col-xs-3{
            padding: 3px;
        }
        .shop-items .item img{ height: 160px !important; }
        .font-size, .shop-items .item .item-dtls .price,.item-dtls > h4 > a{ font-size: 11px !important}
        .shop-items { padding: 0; }
        .myborder{ padding: 5px; }
    }
</style>

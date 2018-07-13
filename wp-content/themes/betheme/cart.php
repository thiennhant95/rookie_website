<?php
/**
 * Template Name: cart
 **/
get_header();
?>
<style>
    .img-cart {
        display: block;
        max-width: 50px;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }
    table tr td{
        border:1px solid #FFFFFF;
    }

    table tr th {
        background:#eee;
    }

    .panel-shadow {
        box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
    }
    .thanhtoan{
        margin-left: 2%!important;
    }
    input[type="number"]{
        width: 100px !important;
        background-color: #fff!important;
        font-family: Avenir, Helvetica, sans-serif;
        color: #0a0a0a;
    }
</style>
<!---->
<?php
// var_dump($_SESSION['products']);
function group_assoc($array, $key) {
    $return = array();
    foreach($array as $v) {
        $return[$v[$key]][] = $v;
    }
    return $return;
}

//Group the requests by their account_id
if (isset($_SESSION['products'])):
$account_requests = group_assoc($_SESSION['products'], 'id_team');
foreach ($account_requests as $key=>$requests_row)
{
    $team_id[]=$key;
}
$_SESSION['team_list']=$team_id;
endif;
$table_products = $wpdb->prefix."products";
$data = "SELECT * FROM $table_products";
$product_list =$wpdb->get_results($data);
$images_url = home_url()."/wp-content/uploads/image-product/";
?>
<div class="container bootstrap snippet">
    <div class="col-md-12 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <div class="panel-body">
                        <?php
                        if (isset($_SESSION['message_qty']) && $_SESSION['message_qty']==1):
                        ?>
                        <div class="alert alert-danger">
                            Số lượng sản phẩm đặt hàng phải lớn hơn 0
                        </div>
                        <?php
                        endif;
                        $_SESSION['message_qty']=0;
                        ?>
                        <div class="table-responsive">
                            <form id="product" method="post" action="<?php echo home_url('shopping')?>">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th width="150px">Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!isset($_SESSION['products']) || count($_SESSION['products'])==0)
                                {
                                    echo "<td colspan='4'>Không có sản phẩm nào trong giỏ hàng.</td>";
                                }
                                else
                                    foreach ($_SESSION['products'] as $key=>$row):
                                        foreach ($product_list as $row_product):
                                            if ($row_product->id==$row['id']):
                                                $arr_image_products =json_decode($row_product->product_images);
                                ?>
                                <tr>
                                    <td><a id="product-name" href="<?php echo home_url('chi-tiet-san-pham/'.$row_product->product_slug)?>"><?php echo $row_product->product_name ?></a><img src="<?php echo $images_url.$arr_image_products[0] ?>" class="img-cart"></td>
                                    <td>
                                        <input class="form-control input-soluong" name="amount[]" type="number" min="1" value="<?php echo $row['qty']?>">
                                    </td>
                                    <td><?php echo number_format($row['price']).'đ' ?></td>
                                    <td><?php echo number_format($row['price']*$row['qty']).'đ' ?> <a href="<?php echo home_url('shopping/')?><?php echo '?removep='.$key.'&return_url='.base64_encode($_SERVER['REQUEST_URI'])?>" class="btn btn-primary thanhtoan"><i class="fa fa-trash-o"></i></td>
                                </tr>
                                                <input type="hidden" name="product[]" value="<?php echo $row_product->id?>" />
                                                <?php
                                                $current_url = base64_encode($_SERVER['REQUEST_URI']);
                                                ?>
                                                <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                                                <input type="hidden" name="type" value="update">
                                                <?php
                                            endif;
                                        endforeach;
                                    endforeach;
                                        ?>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <?php
                                if (isset($_SESSION['products'])):
                                ?>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tổng cộng</strong></a></td>
                                    <td><?php
                                        $sum = 0;
                                        foreach ($_SESSION['products']  as $item) {
                                            $sum += $item['price']*$item['qty'];
                                        }
                                        echo number_format($sum).'đ';
                                        ?></td>
                                </tr>
                                <?php
                                endif;
                                ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="/thanh-toan/" class="btn btn-primary pull-right thanhtoan">Thanh Toán<span class="glyphicon glyphicon-chevron-right"></span></a> &nbsp;
                <a  href="javascript:void()" onclick="document.getElementById('product').submit()" class="btn btn-success pull-right"><span class="glyphicon glyphicon-refresh"></span>&nbsp;  Cập nhật</a>&nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>
<br/>
<?php
get_footer();
?>
<style>
    #product-name:hover{
        text-decoration: none;
    }
</style>

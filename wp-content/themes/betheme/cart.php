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
<div class="container bootstrap snippet">
    <div class="col-md-12 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <div class="panel-body">
                        <div class="table-responsive">
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
                                <tr>
                                    <td><img src="https://lorempixel.com/400/200/fashion/2/" class="img-cart"></td>
                                    <td>
                                        <input class="form-control input-soluong" type="number" value="1">
                                    </td>
                                    <td>$54.00</td>
                                    <td>$54.00 <a href="#" class="btn btn-primary thanhtoan"><i class="fa fa-trash-o"></i></td>
                                </tr>
                                <tr>
                                    <td><img src="https://lorempixel.com/400/200/fashion/1/" class="img-cart"></td>
                                    <td>
                                            <input class="form-control" type="number" value="2">
                                    </td>
                                    <td>$16.00</td>
                                    <td>$54.00 <a href="#" class="btn btn-primary thanhtoan"><i class="fa fa-trash-o"></i></td>
                                </tr>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td colspan="3" class="text-right">Total Product</td>-->
<!--                                    <td>$86.00</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td colspan="3" class="text-right">Total Shipping</td>-->
<!--                                    <td>$2.00</td>-->
<!--                                </tr>-->
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total</strong></a></td>
                                    <td>$88.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary pull-right thanhtoan">Thanh Toán<span class="glyphicon glyphicon-chevron-right"></span></a> &nbsp;
                <a href="#" class="btn btn-success pull-right"><span class="glyphicon glyphicon-repeat"></span>&nbsp;  Cập nhật</a>&nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>
<br/>
<?php
get_footer();
?>
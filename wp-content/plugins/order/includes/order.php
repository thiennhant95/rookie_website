<?php
function show_order_view()
{
    global $wpdb;
    $table_products = $wpdb->prefix."order";
    $data = "SELECT SUM(total_no_ship) as sum_no_ship FROM $table_products WHERE order_status=1";
    $sum_no_ship =$wpdb->get_results($data);

    $data1 = "SELECT SUM(total_price) as sum_ship FROM $table_products WHERE order_status=1";
    $sum_ship =$wpdb->get_results($data1);

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <div class="content-wrapper">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ĐƠN ĐẶT HÀNG</h3>
            </div>
            <div class="col-md-12">
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">ĐƠN HÀNG CHUNG</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">ĐƠN HÀNG ROOKIE</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1primary">
<!--                                <div class="box-body">-->
<!--                                    <div class="container">-->
<!--                                        <div class="row">-->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                                                <div class="btn btn-default col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-6 col-xs-6 col-sm-6"><strong>Họ Tên</strong></div>
                                                    <div class="col-md-6 col-xs-6 col-sm-6"><strong>Trạng Thái</strong></div>
                                                </div>
                                                <?php
                                                $table_order = $wpdb->prefix."order";
                                                $query_order = "SELECT * FROM $table_order ORDER BY id DESC";
                                                $data_order = $wpdb->get_results($query_order);
                                                foreach($data_order as $order){
                                                    ?>
                                                    <div class="btn btn-<?php
                                                    if($order->order_status == 0){
                                                        echo "danger";
                                                    }
                                                    else if($order->order_status == 1){
                                                        echo "success";
                                                    }
                                                    else if($order->order_status == 2){
                                                        echo "warning";
                                                    }
                                                    else if($order->order_status == 3){
                                                        echo "default";
                                                    }
                                                    else if($order->order_status == 4){
                                                        echo "default";
                                                    }
                                                    ?>
                                                    col-md-12 col-sm-12 col-xs-12 text-center" data-toggle="collapse" data-target="#order<?php echo $order->id ?>">
                                                        <div class="col-md-6 col-xs-6 col-sm-6"><?php echo $order->order_name."(".$order->id.")"; ?></div>
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
                                                                    echo "Hủy";
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
                                                                    <td><?php echo number_format($order_detail->price).'đ' ?></td>
                                                                    <td><?php echo number_format($order_detail->detail_total_price).'đ' ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot class="text-center">
                                                            <tr>
                                                                <td colspan="4" class="text-right" style="padding-right: 15px"><strong>Tổng tiền : <?php echo number_format($order->total_price).'đ' ?></strong></td>
                                                            </tr>
<!--                                                            --><?php //if($order->order_status == 0){ ?>
<!--                                                                <tr>-->
<!--                                                                    <td colspan="4"><button type="submit" class="btn btn-success" name="btn-success" style="margin-right: 15px">Xác nhận</button><button type="submit" class="btn btn-danger" name="btn-cancel">Huỷ đơn hàng</button></td>-->
<!--                                                                </tr>-->
<!--                                                            --><?php //} ?>
                                                            </tfoot>

                                                        </table>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                            <div class="tab-pane fade" id="tab2primary">
<!--                                <div class="box-body">-->
<!--                                    <div class="container">-->
<!--                                        <div class="row">-->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                                                <div class="btn btn-default col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-6 col-xs-6 col-sm-6"><strong>Họ Tên</strong></div>
                                                    <div class="col-md-6 col-xs-6 col-sm-6"><strong>Trạng Thái</strong></div>
                                                </div>
                                                <?php
                                                $table_order1 = $wpdb->prefix."order";
                                                $query_order1 = "SELECT * FROM $table_order1 WHERE team_id=0 ORDER BY id DESC";
                                                $data_order1 = $wpdb->get_results($query_order1);
                                                if (count($data_order1)<1)
                                                {
                                                    ?>
                                                    <div class="btn btn-default col-md-12 col-sm-12 col-xs-12">Không có đơn hàng nào</div>
                                                    <?php
                                                }
                                                foreach($data_order1 as $order1){
                                                    ?>
                                                    <div id=order-<?php echo $order1->id ?>" class="btn btn-<?php
                                                    if($order1->order_status == 0){
                                                        echo "danger";
                                                    }
                                                    else if($order1->order_status == 1){
                                                        echo "success";
                                                    }
                                                    else if($order1->order_status == 2){
                                                        echo "warning";
                                                    }
                                                    else if($order1->order_status == 3){
                                                        echo "default";
                                                    }
                                                    else if($order1->order_status == 4){
                                                        echo "default";
                                                    }
                                                    ?>
                                                    col-md-12 col-sm-12 col-xs-12 text-center" data-toggle="collapse" data-target="#order1<?php echo $order1->id ?>">
                                                        <div class="col-md-6 col-xs-6 col-sm-6"><?php echo $order->order_name."(".$order1->id.")"; ?></div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <strong>
                                                                <?php
                                                                if($order1->order_status == 0){
                                                                    echo "Chưa xử lý";
                                                                }
                                                                else if($order1->order_status == 1){
                                                                    echo "Thành công";
                                                                }
                                                                else if($order1->order_status == 2){
                                                                    echo "Đang giao";
                                                                }
                                                                else if($order1->order_status == 3){
                                                                    echo "Huỷ";
                                                                }
                                                                else if($order1->order_status == 4){
                                                                    echo "Trả về";
                                                                }
                                                                ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div id="order1<?php echo $order1->id ?>" class="collapse">
                                                        <table class="table table-bordered table-condensed table-responsive table-striped table-hover">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <p><strong>Email : </strong><a href="mailto:<?php echo $order1->order_email ?>"><?php echo $order1->order_email ?></a></p>
                                                                <p><strong>Số điện thoại :</strong><a href="tel:<?php echo $order1->order_phone ?>"> <?php echo $order1->order_phone ?></a></p>
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
                                                            $table_order_detail1 = $wpdb->prefix."order_detail";
                                                            $table_products1 = $wpdb->prefix."products";
                                                            $query_order_detail1 = $wpdb->prepare("SELECT * FROM $table_order_detail1 WHERE order_id = %d AND team_id = %d",$order1->id,$order1->team_id);
                                                            $data_order_detail1 = $wpdb->get_results($query_order_detail1);
                                                            foreach($data_order_detail1 as $order_detail1){
                                                                $query_product1 = $wpdb->prepare("SELECT * FROM $table_products1 WHERE id = %d",$order_detail1->product_id);
                                                                $product1 = $wpdb->get_row($query_product1);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $product1->product_name ?></td>
                                                                    <td><?php echo $order_detail1->amount ?></td>
                                                                    <td><?php echo number_format($order_detail1->price).'đ' ?></td>
                                                                    <td><?php echo number_format($order_detail1->detail_total_price).'đ' ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot class="text-center">
                                                            <tr>
                                                                <td colspan="4" class="text-right" style="padding-right: 15px"><strong>Tổng tiền : <?php echo number_format($order1->total_price).'đ' ?></strong></td>
                                                            </tr>
                                                            <?php if($order1->order_status == 0){ ?>
                                                                <tr>
                                                                    <td colspan="4"><button type="submit" class="btn btn-success" name="btn-success" style="margin-right: 15px">Xác nhận</button><a href="<?php echo home_url('xu-ly-don-hang')?>" data-id="<?php echo $order1->id ?>" class="btn btn-danger order-cancel">Huỷ đơn hàng</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
    <script>
        $(document).ready(function(){
            $(".order-cancel").click(function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                var id   = '#order-' + $(this).attr('data-id');
                var order_id =$(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: href,
                    dataType : "json",
                    data:{order_id:order_id,type:3}
                })
                    .done(function(data){
                        if (data.status==1)
                        {
                            $(id).removeClass( "btn-danger" ).addClass( "btn-default");
                        }
                    })
            })

        });
        $(document).ready(function(){
            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
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
    </script>
    <style>

        .panel.with-nav-tabs .panel-heading{
            padding: 5px 5px 0 5px;
        }
        .panel.with-nav-tabs .nav-tabs{
            border-bottom: none;
        }
        .panel.with-nav-tabs .nav-justified{
            margin-bottom: -1px;
        }
        /********************************************************************/
        /*** PANEL DEFAULT ***/
        .with-nav-tabs.panel-default .nav-tabs > li > a,
        .with-nav-tabs.panel-default .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li > a:focus {
            color: #777;
        }
        .with-nav-tabs.panel-default .nav-tabs > .open > a,
        .with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-default .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li > a:focus {
            color: #777;
            background-color: #ddd;
            border-color: transparent;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.active > a,
        .with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
            color: #555;
            background-color: #fff;
            border-color: #ddd;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #f5f5f5;
            border-color: #ddd;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #777;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #ddd;
        }
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            color: #fff;
            background-color: #555;
        }
        /********************************************************************/
        /*** PANEL PRIMARY ***/
        .with-nav-tabs.panel-primary .nav-tabs > li > a,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
            color: #fff;
        }
        .with-nav-tabs.panel-primary .nav-tabs > .open > a,
        .with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
            color: #fff;
            background-color: #3071a9;
            border-color: transparent;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a,
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
            color: #428bca;
            background-color: #fff;
            border-color: #428bca;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #428bca;
            border-color: #3071a9;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #fff;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #3071a9;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            background-color: #4a9fe9;
        }
        /********************************************************************/
        /*** PANEL SUCCESS ***/
        .with-nav-tabs.panel-success .nav-tabs > li > a,
        .with-nav-tabs.panel-success .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-success .nav-tabs > li > a:focus {
            color: #3c763d;
        }
        .with-nav-tabs.panel-success .nav-tabs > .open > a,
        .with-nav-tabs.panel-success .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-success .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-success .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-success .nav-tabs > li > a:focus {
            color: #3c763d;
            background-color: #d6e9c6;
            border-color: transparent;
        }
        .with-nav-tabs.panel-success .nav-tabs > li.active > a,
        .with-nav-tabs.panel-success .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-success .nav-tabs > li.active > a:focus {
            color: #3c763d;
            background-color: #fff;
            border-color: #d6e9c6;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #3c763d;
        }
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #d6e9c6;
        }
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            color: #fff;
            background-color: #3c763d;
        }
        /********************************************************************/
        /*** PANEL INFO ***/
        .with-nav-tabs.panel-info .nav-tabs > li > a,
        .with-nav-tabs.panel-info .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-info .nav-tabs > li > a:focus {
            color: #31708f;
        }
        .with-nav-tabs.panel-info .nav-tabs > .open > a,
        .with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-info .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-info .nav-tabs > li > a:focus {
            color: #31708f;
            background-color: #bce8f1;
            border-color: transparent;
        }
        .with-nav-tabs.panel-info .nav-tabs > li.active > a,
        .with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
            color: #31708f;
            background-color: #fff;
            border-color: #bce8f1;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #31708f;
        }
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #bce8f1;
        }
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            color: #fff;
            background-color: #31708f;
        }
        /********************************************************************/
        /*** PANEL WARNING ***/
        .with-nav-tabs.panel-warning .nav-tabs > li > a,
        .with-nav-tabs.panel-warning .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-warning .nav-tabs > li > a:focus {
            color: #8a6d3b;
        }
        .with-nav-tabs.panel-warning .nav-tabs > .open > a,
        .with-nav-tabs.panel-warning .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-warning .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-warning .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-warning .nav-tabs > li > a:focus {
            color: #8a6d3b;
            background-color: #faebcc;
            border-color: transparent;
        }
        .with-nav-tabs.panel-warning .nav-tabs > li.active > a,
        .with-nav-tabs.panel-warning .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-warning .nav-tabs > li.active > a:focus {
            color: #8a6d3b;
            background-color: #fff;
            border-color: #faebcc;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #fcf8e3;
            border-color: #faebcc;
        }
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #8a6d3b;
        }
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #faebcc;
        }
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            color: #fff;
            background-color: #8a6d3b;
        }
        /********************************************************************/
        /*** PANEL DANGER ***/
        .with-nav-tabs.panel-danger .nav-tabs > li > a,
        .with-nav-tabs.panel-danger .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-danger .nav-tabs > li > a:focus {
            color: #a94442;
        }
        .with-nav-tabs.panel-danger .nav-tabs > .open > a,
        .with-nav-tabs.panel-danger .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-danger .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-danger .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-danger .nav-tabs > li > a:focus {
            color: #a94442;
            background-color: #ebccd1;
            border-color: transparent;
        }
        .with-nav-tabs.panel-danger .nav-tabs > li.active > a,
        .with-nav-tabs.panel-danger .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-danger .nav-tabs > li.active > a:focus {
            color: #a94442;
            background-color: #fff;
            border-color: #ebccd1;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #f2dede; /* bg color */
            border-color: #ebccd1; /* border color */
        }
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #a94442; /* normal text color */
        }
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #ebccd1; /* hover bg color */
        }
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            color: #fff; /* active text color */
            background-color: #a94442; /* active bg color */
        }


        /*  bhoechie tab */
        div.bhoechie-tab-container{
            z-index: 10;
            background-color: #ffffff;
            padding: 0 !important;
            border-radius: 4px;
            -moz-border-radius: 4px;
            border:1px solid #ddd;
            margin-top: 20px;
            margin-left: 0px;
            -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
            -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            background-clip: padding-box;
            opacity: 0.97;
            filter: alpha(opacity=97);
        }
        div.bhoechie-tab-menu{
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;
        }
        div.bhoechie-tab-menu div.list-group{
            margin-bottom: 0;
        }
        div.bhoechie-tab-menu div.list-group>a{
            margin-bottom: 0;
        }
        div.bhoechie-tab-menu div.list-group>a .glyphicon,
        div.bhoechie-tab-menu div.list-group>a .fa {
            color: #2d6987;
        }
        div.bhoechie-tab-menu div.list-group>a:first-child{
            border-top-right-radius: 0;
            -moz-border-top-right-radius: 0;
        }
        div.bhoechie-tab-menu div.list-group>a:last-child{
            border-bottom-right-radius: 0;
            -moz-border-bottom-right-radius: 0;
        }
        div.bhoechie-tab-menu div.list-group>a.active,
        div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
        div.bhoechie-tab-menu div.list-group>a.active .fa{
            background-color: #2d6987;
            background-image: #2d6987;
            color: #ffffff;
        }
        div.bhoechie-tab-menu div.list-group>a.active:after{
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            margin-top: -13px;
            border-left: 0;
            border-bottom: 13px solid transparent;
            border-top: 13px solid transparent;
            border-left: 10px solid #2d6987;
        }

        div.bhoechie-tab-content{
            background-color: #ffffff;
            /* border: 1px solid #eeeeee; */
            padding-left: 20px;
            padding-top: 10px;
        }

        div.bhoechie-tab div.bhoechie-tab-content:not(.active){
            display: none;
        }
        .table-revenue tr th {
            color: #1c2d3f;
            font-weight: bold;
        }
        .table-revenue tr td {
            color: #ED2728;
            font-weight: bold;
        }
    </style>
    <?php
}
?>

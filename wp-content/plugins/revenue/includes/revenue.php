<?php
function show_revenue_view()
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
                <h3 class="box-title">DOANH THU</h3>
            </div>
            <div class="col-md-12">
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">DOANH THU CHUNG</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">THEO NHÓM</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1primary">
                                <div class="box-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-9 bhoechie-tab-container">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                                                    <div class="list-group">
                                                        <a href="#" class="list-group-item active text-center">
                                                            <h4 class="glyphicon glyphicon-home"></h4><br/TỔNG
                                                        </a>
                                                        <a href="#" class="list-group-item text-center">
                                                            <h4 class="glyphicon glyphicon-asterisk"></h4><br/>THEO NGÀY
                                                        </a>
                                                        <a href="#" class="list-group-item text-center">
                                                            <h4 class="glyphicon glyphicon-th-large"></h4><br/>THEO THÁNG
                                                        </a>
                                                        <a href="#" class="list-group-item text-center">
                                                            <h4 class="glyphicon glyphicon-th-list"></h4><br/>THEO NĂM
                                                        </a>
<!--                                                        <a href="#" class="list-group-item text-center">-->
<!--                                                            <h4 class="glyphicon glyphicon-shopping-cart"></h4><br/>THEO SẢN PHẨM-->
<!--                                                        </a>-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                                                    <!-- flight section -->
                                                    <!-- train section -->
                                                    <div class="bhoechie-tab-content active">

                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <h4>Doanh Thu Chung</h4>
                                                        <table class="table table-bordered table-striped table-revenue">
                                                            <tr>
                                                                <th>Doanh Thu</th>
                                                                <th>Doanh Thu Tính Phí Ship</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo number_format($sum_no_ship[0]->sum_no_ship).'đ'?></td>
                                                                <td><?php echo number_format($sum_ship[0]->sum_ship).'đ'?></td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <!-- hotel search -->
                                                    <div class="bhoechie-tab-content">
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <?php
                                                        if (isset($_POST['date_choise'])){
                                                        }
                                                        else{
                                                            $date = date('Y-m-d');
                                                        }
                                                        ?>
                                                        <h4>Doanh Thu Theo Ngày <?php echo date('d-m-Y',strtotime($date))  ?></h4>
                                                        <form action="<?php echo admin_url('admin.php?page=revenue_view')?>" id="form-date" method="post">
                                                        <input type="date" value="" onchange="document.getElementById('form-date').submit();" name="date_choise">
                                                        </form>
                                                        <br/>
                                                        <table class="table table-bordered table-striped table-revenue">
                                                            <?php
                                                            $data_date = "SELECT SUM(total_price) as sum_ship FROM $table_products WHERE order_status=1 AND order_date='$date'";
                                                            $sum_ship_date =$wpdb->get_results($data_date);

                                                            $data_date1 = "SELECT SUM(total_no_ship) as sum_no_ship FROM $table_products WHERE order_status=1 AND order_date='$date'";
                                                            $sum_ship_date1 =$wpdb->get_results($data_date1);

                                                            ?>
                                                            <tr>
                                                                <th>Doanh Thu</th>
                                                                <th>Doanh Thu Tính Phí Ship</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo number_format($sum_ship_date1[0]->sum_no_ship).'đ'?></td>
                                                                <td><?php echo number_format($sum_ship_date[0]->sum_ship).'đ'?></td>
                                                            </tr>
                                                        </table>


                                                    </div>

                                                    <div class="bhoechie-tab-content">
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <?php
                                                        if (isset($_POST['date_choise1'])){
                                                            $date1 = $_POST['date_choise1'];
                                                            $Period = explode('-',$date1);
                                                        }
                                                        else{
                                                            $date1 = date('Y-m');
                                                            $Period = explode('-',$date1);
                                                        }
                                                        ?>
                                                        <h4>Doanh Thu Theo Tháng <?php echo date('m-Y',strtotime($date1))  ?></h4>
                                                        <form action="<?php echo admin_url('admin.php?page=revenue_view')?>" id="form-month" method="post">
                                                            <input type="month" value="" onchange="document.getElementById('form-month').submit();" name="date_choise1">
                                                        </form>
                                                        <table class="table table-bordered table-striped table-revenue">
                                                            <?php
                                                            $data_month = "SELECT SUM(total_price) as sum_ship FROM $table_products WHERE order_status=1 AND YEAR(order_date)='$Period[0]' AND MONTH(order_date)='$Period[1]'";
                                                            $sum_ship_month =$wpdb->get_results($data_month);

                                                            $data_month1 = "SELECT SUM(total_no_ship) as sum_no_ship FROM $table_products WHERE order_status=1 AND YEAR(order_date)='$Period[0]' AND MONTH(order_date)='$Period[1]'";
                                                            $sum_ship_month1 =$wpdb->get_results($data_month1);

                                                            ?>
                                                            <tr>
                                                                <th>Doanh Thu</th>
                                                                <th>Doanh Thu Tính Phí Ship</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo number_format($sum_ship_month1[0]->sum_no_ship).'đ'?></td>
                                                                <td><?php echo number_format($sum_ship_month[0]->sum_ship).'đ'?></td>
                                                            </tr>
                                                        </table>


                                                    </div>
                                                    <div class="bhoechie-tab-content">
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <?php
                                                        if (isset($_POST['date_choise2'])){
                                                            $date2 = $_POST['date_choise2'];
                                                        }
                                                        else{
                                                            $date2 = date('Y');
                                                        }

                                                        $years = range(2018, strftime("%Y", time()));
                                                        ?>
                                                        <h4>Doanh Thu Theo Tháng <?php echo $date2  ?></h4>
                                                        <form action="<?php echo admin_url('admin.php?page=revenue_view')?>" id="form-year" method="post">
                                                            <select onchange="document.getElementById('form-year').submit();" name="date_choise2" >
                                                                <option>Chọn Năm</option>
                                                                <?php foreach($years as $year) : ?>
                                                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </form>
                                                        <table class="table table-bordered table-striped table-revenue">
                                                            <?php
                                                            $data_year = "SELECT SUM(total_price) as sum_ship FROM $table_products WHERE order_status=1 AND YEAR(order_date)='$date2'";
                                                            $sum_ship_year =$wpdb->get_results($data_year);

                                                            $data_year1 = "SELECT SUM(total_no_ship) as sum_no_ship FROM $table_products WHERE order_status=1 AND YEAR(order_date)='$date2'";
                                                            $sum_ship_year1 =$wpdb->get_results($data_year1);

                                                            ?>
                                                            <tr>
                                                                <th>Doanh Thu</th>
                                                                <th>Doanh Thu Tính Phí Ship</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo number_format($sum_ship_year1[0]->sum_no_ship).'đ'?></td>
                                                                <td><?php echo number_format($sum_ship_year[0]->sum_ship).'đ'?></td>
                                                            </tr>
                                                        </table>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2primary">
                                <?php
                                $team_table ='order_team';
                                $query = "SELECT *, SUM(total_price) as sum_ship FROM $team_table WHERE $team_table.order_status='1' GROUP BY $team_table.team_id ORDER BY $team_table.team_id";
                                $sum_ship_team =$wpdb->get_results($query);

                                $query1 = "SELECT *, SUM(total_no_ship) as sum_no_ship FROM $team_table WHERE $team_table.order_status='1' GROUP BY $team_table.team_id";
                                $sum_ship_team1 =$wpdb->get_results($query1);

                                $query2 = "SELECT *, COUNT(IF(order_status='3',1,null)) as count_cancel,COUNT(IF(order_status='1',1,null)) as count_success FROM $team_table GROUP BY $team_table.team_id";
                                $sum_ship_team2 =$wpdb->get_results($query2);

                                ?>
                                <table id="team-table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id nhóm</th>
                                        <th>Tên nhóm</th>
                                        <th>Doanh Thu (VNĐ)</th>
                                        <th>Doanh Thu có ship (VNĐ)</th>
                                        <th>Đơn hàng thành công</th>
                                        <th>Đơn hàng hủy</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($sum_ship_team as $row) {
                                        foreach ($sum_ship_team1 as $row1) {
                                            foreach ($sum_ship_team2 as $row2) {
                                                if ($row->team_id == $row1->team_id && $row->team_id ==$row2->team_id):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row->team_id ?></td>
                                                        <td><?php echo $row->ten_nhom ?></td>
                                                        <td><?php echo number_format($row->sum_ship) ?></td>
                                                        <td><?php echo number_format($row1->sum_no_ship) ?></td>
                                                        <td><?php echo($row2->count_success) ?></td>
                                                        <td><?php echo($row2->count_cancel) ?></td>
                                                    </tr>
                                                <?php
                                                endif;
                                            }
                                        }
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
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
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
            margin-left: 50px;
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
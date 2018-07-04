<?php
function show_company_view()
{
    global $wpdb;
    $table_products = $wpdb->prefix."products";
    $data = "SELECT * FROM $table_products";
    $product_list =$wpdb->get_results($data);
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css">
    <div class="content-wrapper">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản Lý Sản Phẩm</h3>
                <!--            <br/>-->
                <h3 class="box-title" style="float: right"><a class="btn btn-primary btn-flat" href="<?php echo site_url('admin/product/add')?>">Thêm Sản Phẩm Mới</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="product-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Danh Mục</th>
                        <th>Giá (VNĐ)</th>
                        <th>Tồn Kho</th>
                        <th>Hình Ảnh</th>
                        <th>Trạng Thái</th>
                        <th>Chức Năng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($product_list as $row)
                    {
                        $product_images =json_decode($row->product_images)
                        ?>
                        <tr>
                            <td><?php echo $row->id?></td>
                            <td><?php echo $row->product_name ?></td>
                            <td><?php if ($row->category_product_id==1) echo "Ca Cao";
                                else if ($row->category_product_id==2) echo "Chocolate";
                                else if ($row->category_product_id==3) echo "Cà Phê";
                                else echo "Tổng hợp";
                                ?></td>
                            <td><?php echo (number_format($row->product_price))?></td>
                            <td><?php echo $row->warehouse_amount ?></td>
                            <td><img class="img-thumbnail" alt="Cinque Terre" src="../<?php echo $product_images[0] ?>" width="80" height="80"></td>
                            <td><?php echo $row->status==1?'<span class="badge bg-green">Đang hiển thị</span>':'<span class="badge bg-red">Không hiển thị</span>'?></td>
                            <td>
                                <a class="btn btn-primary btn-flat" href="<?php echo site_url('admin/product/edit/'.$row->product_name) ?>">Sửa</a>
                                <br class="visible-xs visible-sm">
                                <br class="visible-xs visible-sm">
                                <a href="#" title="Are you sure?" class="btn btn-danger btn-flat popovers" data-placement="left"  data-toggle="popover"  data-trigger="focus" data-content="
                                                <div>
                                                <a class='btn btn-flat btn-sm btn-default pull-left' data-trigger='focus'><span class='glyphicon glyphicon-remove'></span></a>&nbsp
                                                <a class='btn btn-flat btn-danger btn-sm pull-right' href='<?php echo site_url('admin/product/product_delete/'.$row->id) ?>' ><span class='glyphicon glyphicon-ok'></span></a>
                                                </div>
                                                " data-html="true"  data-type="Group">Xóa</a>
                            </td>
                        </tr>
                        <?php
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
    </style>

    <script>
        $('.popovers').click(function (e) {
            e.preventDefault();
        });
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
        $(document).ready(function(){
            $("#product-table").DataTable({
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
    <?php
}
?>
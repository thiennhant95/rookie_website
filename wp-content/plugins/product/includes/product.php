<?php
function show_company_view()
{
    ?>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!--                    <th></th>-->
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <?php
}
?>
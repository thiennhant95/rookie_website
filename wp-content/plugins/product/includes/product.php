<?php
function show_company_view()
{
    global $wpdb;
    $table_products = $wpdb->prefix."products";
    $data = "SELECT * FROM $table_products WHERE is_delete=1";
    $product_list =$wpdb->get_results($data);
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css">
    <div <?php if (isset($_GET['add_product'])==1) echo "style='display:none'"?> class="content-wrapper">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản Lý Sản Phẩm</h3>
                <!--            <br/>-->
                <h3 class="box-title" style="float: right"><a class="btn btn-primary btn-flat" href="../wp-admin/admin.php?page=product_view&add_product=1">Thêm Sản Phẩm Mới</a></h3>
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
                                                <a class='btn btn-flat btn-danger btn-sm pull-right' href='<?php echo '../xoa-product/?id='.$row->id.'&type=delete' ?>' ><span class='glyphicon glyphicon-ok'></span></a>
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
        .bg-green{
            background-color: #5cb85c;
        }
        .bg-red{
            background-color: #d53239;
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
    if (isset($_GET['add_product']) && $_GET['add_product']==1)
    {
        ?>
        <div class="content-wrapper">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thêm Sản Phẩm mới</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p class="login-box-msg">
                    </p>
                    <div class="box box-info">
                        <div class="box-body">
                            <form id="product-form" action="<?php echo site_url('admin/product/add')?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Chọn Danh Mục Sản Phẩm:</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="1">Ca cao</option>
                                        <option value="2">Chocolate</option>
                                        <option value="3">Cà phê</option>
                                        <option value="4">Tổng Hợp</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tên Sản Phẩm:</label>
                                    <input type="text" name="product_name" required="required" class="form-control">
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>Khối lượng tịnh (nếu có):</label>
                                    <input type="number" name="net_weight" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Đơn giá (VNĐ):</label>
                                    <input type="number" name="product_price" required="required" class="form-control">
                                </div>

<!--                                <div class="form-group">-->
<!--                                    <label>Giảm giá (VNĐ):</label>-->
<!--                                    <input type="number" name="discount" required="required" class="form-control">-->
<!--                                </div>-->

                                <div class="form-group">
                                    <label>Số lượng tồn kho:</label>
                                    <input type="number" name="warehouse_amount" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Ngày sản xuất (nếu có):</label>
                                    <input type="date" name="warehouse_amount" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Ngày hết hạn (nếu có):</label>
                                    <input type="date" name="warehouse_amount" class="form-control">
                                </div>
                                <!-- /.form group -->
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <textarea class="form-control" id="content" name="content" required></textarea>
                                </div>
                                <?php

                                $content = "";
                                $editor_id = "admin_editor";
                                $settings =   array(
                                    "wpautop" => true,
                                    "media_buttons" => false,
                                    "textarea_name" => $editor_id,
                                    "textarea_rows" => get_option("default_post_edit_rows", 7),
                                    "quicktags" => true
                                );
                                wp_editor( $content, $editor_id, $settings = array() );
                                ?>

                                <div class="form-group">
                                    <label>Hình ảnh (Chọn tối đa 4 hình ảnh):</label>
                                    <input class="form-control" name="product_images[]" type="file" multiple="multiple" required>
                                </div>
                                <!-- Color Picker -->
                                <div class="form-group">
                                    <label>Trạng Thái:</label>
                                    <select class="form-control" name="status_product" required>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Không hiển thị</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-flat" type="submit" value="Thêm">
                                </div>
                                <!-- /.input group -->
                            </form>
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        </div>

        <style>
            #slide-table td
            {
                vertical-align:middle;
            }
        </style>

        <script type="text/javascript">
            $(function() {
                var editor = CKEDITOR.replace('content',
                    {
                        filebrowserBrowseUrl : '<?php echo base_url()."admin/ckfinder/ckfinder.html"; ?>',
                        filebrowserImageBrowseUrl : '<?php  echo base_url()."admin/ckfinder/ckfinder.html?Type=Images";?>',
                        filebrowserFlashBrowseUrl : '<?php  echo base_url()."admin/ckfinder/ckfinder.html?Type=Flash" ?>',
                        filebrowserUploadUrl : '<?php echo base_url()."admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
                        filebrowserImageUploadUrl : '<?php  echo base_url()."admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";?>',
                        filebrowserFlashUploadUrl : '<?php  echo base_url()."admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";?>',
                        filebrowserWindowWidth : '600',
                        filebrowserWindowHeight : '150'
                    });
                CKFinder.setupCKEditor( editor, "<?php  echo base_url().'admin/ckfinder/'?>" );
            });

            $(function(){
                $("input[type='submit']").click(function(e){
                    var $fileUpload = $("input[type='file']");
                    if (parseInt($fileUpload.get(0).files.length)<4){
                        alert("Bạn chọn tối đa 4 hình ảnh");
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                });
            });
        </script>

        <?php
    }
}
?>

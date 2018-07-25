<?php
function show_company_view()
{
    $search = array('\r\n','&lt;br&gt;','\&quot;','\&amp;','\&#039;','\"');
    $replace = array('<br>','<br>','&quot;','&amp;','&#039','"');
    global $wpdb;
    $table_products = $wpdb->prefix."products";
    $data = "SELECT * FROM $table_products WHERE is_delete=0";
    $product_list =$wpdb->get_results($data);
    $target_dir = home_url()."/wp-content/uploads/image-product/";
    ?>
<!--    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<!--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css">
    <div <?php if (isset($_GET['add_product'])==1 ||isset($_GET['update_product'])==1) echo "style='display:none'"?> class="content-wrapper">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quản Lý Sản Phẩm</h3>
                <p>
                    <?php
                    if (isset($_SESSION['themsp']) && $_SESSION['themsp']=='1'):
                    ?>
                <div class="alert alert-success alert-autocloseable-danger">
                    Thêm mới sản phẩm thành công.
                </div>
                <?php
                $_SESSION['themsp']='0';
                endif;
                ?>
                    <?php
                    if (isset($_SESSION['suasp']) && $_SESSION['suasp']=='1'):
                    ?>
                <div class="alert alert-success alert-autocloseable-danger">
                    Sửa mới sản phẩm thành công.
                </div>
                <?php
                $_SESSION['suasp']='0';
                endif;
                    if (isset($_SESSION['suasp']) && $_SESSION['suasp']=='3'):
                        ?>
                        <div class="alert alert-danger alert-autocloseable-danger">
                           Xóa sản phẩm thành công.
                        </div>
                        <?php
                        $_SESSION['suasp']='0';
                    endif;
                ?>
                </p>
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
                        $product_images =json_decode($row->product_images);
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
                            <td><img class="img-thumbnail" alt="Cinque Terre" src="<?php echo $target_dir.$product_images[0] ?>" width="80" height="80"></td>
                            <td><?php echo $row->status==1?'<span class="badge bg-green">Đang hiển thị</span>':'<span class="badge bg-red">Không hiển thị</span>'?></td>
                            <td>
                                <a class="btn btn-primary btn-flat" href="<?php echo '../wp-admin/admin.php?page=product_view&update_product=1&id='.$row->id ?>">Sửa</a>
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
                            <form id="product-form" action="<?php echo home_url('them-product')?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Chọn Danh Mục Sản Phẩm:</label>
                                    <select class="form-control" name="category_product_id" required>
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
                                    <label>Đơn giá (VNĐ):</label>
                                    <input type="number" name="product_price" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Cân nặng (Gam):</label>
                                    <input type="number" name="weight" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Số lượng tồn kho:</label>
                                    <input type="number" name="warehouse_amount" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Ngày sản xuất (nếu có):</label>
                                    <input type="date" name="manufactore_date" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Ngày hết hạn (nếu có):</label>
                                    <input type="date" name="expired_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tóm tắt sản phẩm:</label>
                                    <textarea class="form-control" name="sort_content">
                                    </textarea>
                                </div>
                                <!-- /.form group -->
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <?php
                                    $content = "";
                                    $editor_id = "content";
                                    $settings =   array(
                                        "wpautop" => true,
                                        "media_buttons" => false,
                                        "textarea_name" => $editor_id,
                                        "textarea_rows" => get_option("default_post_edit_rows", 7),
                                        "quicktags" => true
                                    );
                                    wp_editor( $content, $editor_id, $settings = array() );
                                    ?>
                                </div>


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
<!--        </div>-->

        <style>
            #slide-table td
            {
                vertical-align:middle;
            }
        </style>

        <script type="text/javascript">
            // $(function(){
            //     $("input[type='submit']").click(function(e){
            //         var $fileUpload = $("input[type='file']");
            //         if (parseInt($fileUpload.get(0).files.length)<4){
            //             alert("Bạn chọn tối đa 4 hình ảnh");
            //             return false;
            //         }
            //         else
            //         {
            //             return true;
            //         }
            //     });
            // });
        </script>

        <?php
    }

    if (isset($_GET['update_product']) && $_GET['update_product']==1)
    {
        $table_team = $wpdb->prefix . "products";
        $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d", $_GET['id']);
        $data_team = $wpdb->get_row($data_prepare);
        ?>
        <div class="content-wrapper">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cập nhật Sản Phẩm</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p class="login-box-msg">
                    </p>
                    <div class="box box-info">
                        <div class="box-body">
                            <form id="product-form" action="<?php echo home_url('update-product?id='.$_GET['id'])?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Chọn Danh Mục Sản Phẩm:</label>
                                    <select class="form-control" name="category_product_id" required>
                                        <option value="1" <?php if ($data_team->category_product_id==1) echo "selected"?> >Ca cao</option>
                                        <option value="2" <?php if ($data_team->category_product_id==2) echo "selected"?> >Chocolate</option>
                                        <option value="3" <?php if ($data_team->category_product_id==3) echo "selected"?> >Cà phê</option>
                                        <option value="4" <?php if ($data_team->category_product_id==4) echo "selected"?> >Tổng Hợp</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tên Sản Phẩm:</label>
                                    <input type="text" name="product_name" value="<?php echo $data_team->product_name ?>" required="required" class="form-control">
                                </div>
                                <!-- /.form group -->
                                <div class="form-group">
                                    <label>Đơn giá (VNĐ):</label>
                                    <input type="number" name="product_price" value="<?php echo $data_team->product_price ?>" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Cân nặng (Gam):</label>
                                    <input type="number" name="weight" value="<?php echo $data_team->weight ?>" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Số lượng tồn kho:</label>
                                    <input type="number" name="warehouse_amount" value="<?php echo $data_team->warehouse_amount ?>" required="required" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Ngày sản xuất (nếu có):</label>
                                    <input type="date" name="manufactore_date" value="<?php echo $data_team->manufactore_date?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Ngày hết hạn (nếu có):</label>
                                    <input type="date" value="<?php echo $data_team->expired_date ?>" name="expired_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tóm tắt sản phẩm:</label>
                                    <textarea class="form-control" name="sort_content">
                                        <?php
                                        echo $data_team->product_description;
                                        ?>
                                    </textarea>
                                </div>
                                <!-- /.form group -->
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <?php
                                    $content = str_replace($search,$replace,$data_team->product_long_description);
                                    $editor_id = "content";
                                    $settings =   array(
                                        "wpautop" => true,
                                        "media_buttons" => false,
                                        "textarea_name" => $editor_id,
                                        "textarea_rows" => get_option("default_post_edit_rows", 7),
                                        "quicktags" => true
                                    );
                                    wp_editor( $content, $editor_id, $settings = array() );
                                    ?>
                                </div>


                                <div class="form-group">
                                    <label>Hình ảnh (Chọn tối đa 4 hình ảnh):</label>
                                    <input class="form-control" name="product_images[]" type="file" multiple="multiple">
                                </div>
                                <?php
                                foreach (json_decode($data_team->product_images) as $row)
                                {
                                    ?>
                                   <img class="img-thumbnail" alt="Cinque Terre" src="<?php echo $target_dir.$row?>" width="80" height="80">
                                    <?php
                                }
                                ?>
                                <!-- Color Picker -->
                                <div class="form-group">
                                    <label>Trạng Thái:</label>
                                    <select class="form-control" name="status_product" required>
                                        <option <?php if ($data_team->status==1) echo "selected"?> value="1">Hiển thị</option>
                                        <option <?php if ($data_team->status==0) echo "selected"?> value="0">Không hiển thị</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-flat" type="submit" value="Cập Nhật">
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
        <!--        </div>-->

        <style>
            #slide-table td
            {
                vertical-align:middle;
            }
        </style>

        <script type="text/javascript">
            $(function(){
                // $("input[type='submit']").click(function(e){
                //     var $fileUpload = $("input[type='file']");
                //     if (parseInt($fileUpload.get(0).files.length)<4){
                //         alert("Bạn chọn tối đa 4 hình ảnh");
                //         return false;
                //     }
                //     else
                //     {
                //         return true;
                //     }
                // });
            });
        </script>

        <?php
    }
}
?>

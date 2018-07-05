<?php

if (isset($_POST['id_team']) && $_POST['id_team']!=0)
{
    $id_team =$_POST['id_team'];
}
else
{
    $id_team = 0;
}

//Xóa giỏ hàng bằng cách hủy SESSION
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
    $yourSession= WP_Session_Tokens::get_instance(get_current_user_id());
    $yourSession->destroy_all();
    $url = home_url('gio-hang');
    wp_redirect($url);
    exit;
}
//Thêm sản phẩm vào giỏ hàng
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
    $product_id   = filter_var($_POST["product_id"], FILTER_SANITIZE_STRING); //product id
    $return_url   = base64_decode($_POST["return_url"]); // url trả về
    if ($_POST["product_qty"])
    {
        $product_qty  = filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //số lượng
        if ($product_qty <1)
        {
            $_SESSION['message_qty']=1;
            $url = home_url($return_url);
            wp_redirect($url);
            exit;
        }
    }

    else{$product_qty=1;}



    //Giới hạn sản phẩm
    if($product_qty > 10){
        die('<div align="center">Ví dụ này không quá 10 sản phẩm</div>');
    }

    //Lấy thông tin chi tiết sản phẩm bằng product_id
    $table_team = $wpdb->prefix."products";
    $results = $wpdb->prepare("SELECT * FROM $table_team WHERE id= %d",$product_id);
    $obj = $wpdb->get_row($results);
    if ($results) { //Kiểm tra có dữ liệu hay không

        //Chuẩn bị array(mảng) để lưu thông tin sản phẩm
        $new_product = array(array('name'=>$obj->product_name, 'id'=>$product_id, 'qty'=>$product_qty, 'price'=>$obj->product_price,'id_team'=>$id_team));

        if(isset($_SESSION["products"])) //Hàm kiểm tra nếu có sản phẩm trong giỏ hàng rồi thì cập nhật lại
        {
            $found = false; //Thiết lập mặc định ban đầu biến kiểm tra sản phẩm tồn tại thành false

            foreach ($_SESSION["products"] as $cart_itm) //vòng lặp mảng SESSION
            {
                if($cart_itm["id"] == $product_id){ //sản phẩm đã tồn tại trong mảng
                    if ($return_url=='/san-pham/') $product_qty=$cart_itm["qty"]+1;
                    if ($return_url=='/chocolate/') $product_qty=$cart_itm["qty"]+1;
                    if ($return_url=='/ca-cao/') $product_qty=$cart_itm["qty"]+1;
                    if ($return_url=='/ca-phe/') $product_qty=$cart_itm["qty"]+1;
                    if ($return_url=='/') $product_qty=$cart_itm["qty"]+1;
                    if (strpos($return_url, 'group-team') !== false) $product_qty=$cart_itm["qty"]+1;
                    $product[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"], 'qty'=>$product_qty, 'price'=>$cart_itm["price"],'id_team'=>$id_team);
                    $found = true; // Thiết lập biến kiểm tra sản phẩm tồn tại thành true
                }else{
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"],'id_team'=>$id_team);
                }
            }

            if($found == false) //Không tìm thấy sản phẩm trong giỏ hàng
            {
                //Thêm mới sản phẩm vào mảng
                $_SESSION["products"] = array_merge($product, $new_product);
            }else{
                //Tìm thấy sản phẩm đã có trong mảng SESSION nên chỉ cập nhật lại số lượng(QTY)
                $_SESSION["products"] = $product;
            }

        }else{
            //Tạo biến SESSION mới hoàn toàn nếu không có sản phẩm nào trong giỏ hàng
            $_SESSION["products"] = $new_product;
        }

    }

    //Trở về lại trang cũ
    $url = home_url($return_url);
    wp_redirect($url);
    exit;
}

//Xóa sản phẩm trong giỏ hàng
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"])) {
    $product_id = $_GET["removep"]; //Lấy product_id để xóa
    $return_url = base64_decode($_GET["return_url"]); //lấy url hiện tại


    foreach ($_SESSION["products"] as $cart_itm) //Vòng lặp biến SESSION
    {
        if ($cart_itm["id"] != $product_id) { //Lọc lại giỏ hàng, sản phẩm nào trùng product_id muốn xóa sẽ bị loại bỏ
            $product[] = array('name' => $cart_itm["name"], 'id' => $cart_itm["id"], 'qty' => $cart_itm["qty"], 'price' => $cart_itm["price"],'id_team'=>$id_team);
        }

        //Tạo mới biến SESSION lưu giỏ hàng
        $_SESSION["products"] = $product;
    }

    //Trở về lại trang cũ
    $url = home_url($return_url);
    wp_redirect($url);
    exit;
}

if(isset($_POST["type"]) && $_POST["type"]=='update')
{
    $return_url   = base64_decode($_POST["return_url"]);

    if(isset($_SESSION["products"])) //Hàm kiểm tra nếu có sản phẩm trong giỏ hàng rồi thì cập nhật lại
    {
        foreach ($_SESSION["products"] as $key=>$cart_itm) //vòng lặp mảng SESSION
        {
            foreach ($_POST["amount"] as $key_amount=>$row)
            {
                if($key == $key_amount){
                    if ($row < 1){
                        $_SESSION['message_qty']=1;
                        $url = home_url($return_url);
                        wp_redirect($url);
                        exit;
                    }
                    $product[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"], 'qty'=>$row, 'price'=>$cart_itm["price"]);
                }
            }
        }
        $_SESSION["products"] = $product;
    }
    //Trở về lại trang cũ\
    $url = home_url($return_url);
    wp_redirect($url);
    exit;
}

?>
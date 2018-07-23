<?php
function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
 	}
	return $str;
} 

function CovertVn($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ặ|ẳ|ẵ|ắ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ặ|Ẳ|Ẵ|Ắ)/", 'a', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(Đ)/", 'd', $str);
    $str = strtolower($str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	global $wpdb;
	$table_post_group = $wpdb->prefix . "post_group";
	$table_team = $wpdb->prefix . "team";
	$session_id_team = $_SESSION["branch_id"];
	$query_team = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d",$session_id_team);
	$data_query_team = $wpdb->get_row($query_team);
	if(!empty($_POST["post_title"]) && !empty($_POST["description_post"]) && isset($_FILES["upload-feature"])){
		$title_post = $_POST["post_title"];
		$content_post = $_POST["description_post"];
		$datetime = date("Y-m-d h:i:s");
		$slug_post = CovertVn($title_post);
		$status_post = 1;
		$arr_image = array("image/bmp","image/jpg","image/jpeg","image/png");;
		$max_upload_file = 1024*1024*10;
		$date = date("dmYhis");
		$path_upload = WP_CONTENT_DIR."/uploads/image-post/";
		$url_img = home_url()."/wp-content/uploads/image-post/";
		if(in_array($_FILES["upload-feature"]["type"],$arr_image) && $_FILES["upload-feature"]["size"] <= $max_upload_file && $_FILES["upload-feature"]["error"] == 0){
			$count_explode = explode(".", $_FILES["upload-feature"]["name"]);
			$count_array_explode = count($count_explode);
			$randname = rand_string(10);
			for($i = 0; $i < $count_array_explode; $i++){
				if($i == $count_array_explode-1){
					$change_name = $date."_".$randname;
					$rename_image = $change_name.".".$count_explode[$i];
				}
			}
			$filename_image = $rename_image;
			$size = getimagesize($_FILES["upload-feature"]['tmp_name']);
			if($size[0] > 800 && $size[1] > 600){     
			   $tempfilename = ($_FILES["upload-feature"]['tmp_name']);            
			   $testimage =imagecreatefromjpeg($tempfilename);
			   $image_p = imagecreatetruecolor(800, 600);
			   if(imagecopyresampled($image_p, $testimage, 0, 0, 0, 0, 800, 600, $size[0], $size[1])){
			      imagejpeg($image_p,$_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/image-post/".$filename_image);
			   }
			}
			else if($size[0] < 400 && $size[1] < 300){
			   $tempfilename = ($_FILES["upload-feature"]['tmp_name']);            
			   $testimage =imagecreatefromjpeg($tempfilename);
			   $image_p = imagecreatetruecolor(400, 300);
			   if(imagecopyresampled($image_p, $testimage, 0, 0, 0, 0, 400, 300, $size[0], $size[1])){
			      imagejpeg($image_p,$_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/image-post/".$filename_image);
			   }
			}  
			else{
				move_uploaded_file($_FILES["upload-feature"]["tmp_name"], $path_upload.$filename_image);
			}
		}
		$post_group_image = $url_img.$filename_image;
		$insert = $wpdb->insert($table_post_group,
			array(
				"id" => $wpdb->insert_id,
				"post_group_title" => $title_post,
				"post_group_slug" => $slug_post,
				"post_group_content" => $content_post,
				"post_group_feature" => $post_group_image,
				"post_group_status" => $status_post,
				"post_group_date" => $datetime
			),
			array("%d","%s","%s","%s","%s","%d","%s")
		);
		if($insert){
			$query_post_group = "SELECT * FROM $table_post_group ORDER BY id DESC LIMIT 1";
			$data_query_post_group = $wpdb->get_row($query_post_group);
			$table_team_post = $wpdb->prefix."team_post";
			$status_share = NULL;
			$post_type = 1;
			$insert_team_post = $wpdb->insert($table_team_post,
			array(
				"id" => $wpdb->insert_id,
				"id_post" => $data_query_post_group->id,
				"id_team" => $session_id_team,
				"status_share" => $status_share,
				"post_type" => $post_type,
			),
			array("%d","%d","%d","%s","%d")
			);
			if($insert_team_post){
				$_SESSION["success_post"] = 1;
				$url = home_url()."/manage-group/".$data_query_team->slug;
				wp_redirect($url);
			}
			else{
				$_SESSION["success_post"] = 2;
				$url = home_url()."/manage-group/".$data_query_team->slug;
				wp_redirect($url);
			}
		}
		else{
			$_SESSION["success_post"] = 2;
			$url = home_url()."/manage-group/".$data_query_team->slug;
			wp_redirect($url);
		}
	}
	else{
		$_SESSION["success_post"] = 3;
		$url = home_url()."/manage-group/".$data_query_team->slug;
		wp_redirect($url);
	}
}
?>
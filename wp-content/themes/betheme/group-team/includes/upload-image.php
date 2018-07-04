<?php
function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
 	}
	return $str;
} 
if(isset($_FILES["avatar_group"])){
	$arr_image = array("image/bmp","image/jpg","image/jpeg","image/png");;
	$max_upload_file = 1024*1024*10;
	$date = date("dmYhis");
	$path_upload = WP_CONTENT_DIR."/uploads/avatar-group/";
	$url_img = home_url()."/wp-content/uploads/avatar-group/";
	$session_id_team = $_SESSION["branch_id"];
	if(in_array($_FILES["avatar_group"]["type"],$arr_image) && $_FILES["avatar_group"]["size"] <= $max_upload_file && $_FILES["avatar_group"]["error"] == 0){
		$count_explode = explode(".", $_FILES["avatar_group"]["name"]);
		$count_array_explode = count($count_explode);
		$randname = rand_string(10);
		for($i = 0; $i < $count_array_explode; $i++)
		{
			if($i == $count_array_explode-1)
			{
				$change_name = $date."_".$randname;
				$rename_image = $change_name.".".$count_explode[$i];
			}
		}
		$filename_image = $rename_image;
		$size = getimagesize($_FILES["avatar_group"]['tmp_name']);
		if($size[0] > 800 && $size[1] > 600)
		{     
		   $tempfilename = ($_FILES["avatar_group"]['tmp_name']);            
		   $testimage =imagecreatefromjpeg($tempfilename);
		   $image_p = imagecreatetruecolor(800, 600);
		   if(imagecopyresampled($image_p, $testimage, 0, 0, 0, 0, 800, 600, $size[0], $size[1])){
		      imagejpeg($image_p,$_SERVER["DOCUMENT_ROOT"]."/wp-content/uploads/avatar-group/".$filename_image);
		   }
		}  
		else
		{
			move_uploaded_file($_FILES["avatar_group"]["tmp_name"], $path_upload.$filename_image);
		}
		$group_image = $url_img.$filename_image;
		global $wpdb;
		$table_team = $wpdb->prefix . "team";
		$update = $wpdb->update($table_team,
			array("logo" => $group_image),
			array("id" => $session_id_team)
		);
		if($update)
		{
			$notice = "<div class='alert alert-success'>Cập nhật ảnh đại diện thành công</div>";
			echo $notice;
		}
		else
		{
			$notice = "<div class='alert alert-danger'>Cập nhật ảnh đại diện không thành công</div>";
			echo $notice;
		}
	}
	else{
		$notice = "<div class='alert alert-danger'>Ảnh đại diện phải thuộc kiểu png, jpg, bmp, jpeg và không được quá kích thước 10MB</div>";
		echo $notice;
	}
}
if(isset($_FILES["background_group"])){
	$arr_image = array("image/bmp","image/jpg","image/jpeg","image/png");;
	$max_upload_file = 1024*1024*10;
	$date = date("dmYhis");
	$path_upload = WP_CONTENT_DIR."/uploads/avatar-group/";
	$url_img = home_url()."/wp-content/uploads/avatar-group/";
	$session_id_team = $_SESSION["branch_id"];
	if(in_array($_FILES["background_group"]["type"],$arr_image) && $_FILES["background_group"]["size"] <= $max_upload_file && $_FILES["error"] == 0){
		$count_explode = explode(".", $_FILES["background_group"]["name"]);
		$count_array_explode = count($count_explode);
		$randname = rand_string(10);
		for($i = 0; $i < $count_array_explode; $i++)
		{
			if($i == $count_array_explode-1)
			{
				$change_name = "bg_".$date."_".$randname;
				$rename_image = $change_name.".".$count_explode[$i];
			}
		}
		$filename_image = $rename_image;
		move_uploaded_file($_FILES["background_group"]["tmp_name"], $path_upload.$filename_image);
		$group_image = $url_img.$filename_image;
		global $wpdb;
		$table_team = $wpdb->prefix . "team";
		$update = $wpdb->update($table_team,
			array("background" => $group_image),
			array("id" => $session_id_team)
		);
		if($update)
		{
			$notice = "<div class='alert alert-success'>Cập nhật ảnh bìa thành công</div>";
			echo $notice;
		}
		else
		{
			$notice = "<div class='alert alert-danger'>Cập nhật ảnh bìa không thành công</div>";
			echo $notice;
		}
	}
	else{
		$notice = "<div class='alert alert-danger'>Ảnh bìa phải thuộc kiểu png, jpg, bmp, jpeg và không được quá kích thước 10MB</div>";
		echo $notice;
	}
}
?>
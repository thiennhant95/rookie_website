<?php 
if(isset($_POST["xacnhan"]) && isset($_POST["oldpassword"]) && isset($_POST["newpassword"]) && isset($_POST["newpassword_confirm"]))
{
	global $wpdb;
	$oldpassword = sha1($_POST["oldpassword"]);
	$newpassword = sha1($_POST["newpassword"]);
	$newpassword_confirm = sha1($_POST["newpassword_confirm"]);
	$session_id_team = $_SESSION["branch_id"];
	$table_team = $wpdb->prefix . "team";
	$query_team = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d",$session_id_team);
	$data_query_team = $wpdb->get_row($query_team);
	$query_change_password = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d AND mat_khau_nhom = %s",$session_id_team,$oldpassword);
	$data_team = $wpdb->get_row($query_change_password);
	if(!empty($data_team)){
		if($newpassword == $newpassword_confirm){
			$update = $wpdb->update($table_team,
				array("mat_khau_nhom" => htmlspecialchars($newpassword)),
				array("id" => $session_id_team)
			);
			if($update){
				$_SESSION["success_change"] = 1;
				$url = home_url()."/manage-group/".$data_query_team->slug;
				wp_redirect($url);
			}
			else{
				$_SESSION["success_change"] = 2;
				$url = home_url()."/manage-group/".$data_query_team->slug;
				wp_redirect($url);
			}
		}
		else{
			$_SESSION["success_change"] = 3;
			$url = home_url()."/manage-group/".$data_query_team->slug;
			wp_redirect($url);
		}
	}
	else{
		$_SESSION["success_change"] = 4;
		$url = home_url()."/manage-group/".$data_query_team->slug;
		wp_redirect($url);
	}
}
?>
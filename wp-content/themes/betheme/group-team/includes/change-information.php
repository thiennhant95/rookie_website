<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $table_team = $wpdb->prefix . "team";
        $session_id_team = $_SESSION["branch_id"];
		$query_team = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d",$session_id_team);
		$data_query_team = $wpdb->get_row($query_team);
        if ( $_POST['lead_username'] == null || $_POST['lead_school'] == null
            || $_POST['lead_phone'] == null || $_POST['lead_birthday'] == null ||
            $_POST['u1_username'] == null || $_POST['u1_school'] == null
            || $_POST['u1_phone'] == null || $_POST['u1_birthday'] == null ||
            $_POST['u2_username'] == null || $_POST['u2_school'] == null
            || $_POST['u2_phone'] == null || $_POST['u2_birthday'] == null)
        {
			$_SESSION["success_change_info"] = 2;
			$url = home_url()."/manage-group/".$data_query_team->slug;
			wp_redirect($url);
        }
        else{
			if(!empty($data_query_team)){
				$update = $wpdb->update($table_team,
					array(
						"ten_truong_nhom" => htmlspecialchars($_POST['lead_username']),
						"truong_truong_nhom" => htmlspecialchars($_POST['lead_school']),
						"sdt_truong_nhom" => htmlspecialchars($_POST['lead_phone']),
						"namsinh_truong_nhom" => htmlspecialchars($_POST['lead_birthday']),
						"ten_member_1" => htmlspecialchars($_POST["u1_username"]),
						"truong_member_1" => htmlspecialchars($_POST["u1_school"]),
						"sdt_member_1" => htmlspecialchars($_POST["u1_phone"]),
						"namsinh_member_1" => htmlspecialchars($_POST["u1_birthday"]),
						"ten_member_2" => htmlspecialchars($_POST["u2_username"]),
						"truong_member_2" => htmlspecialchars($_POST["u2_school"]),
						"sdt_member_2" => htmlspecialchars($_POST["u2_phone"]),
						"namsinh_member_2" => htmlspecialchars($_POST["u2_birthday"])
					),
					array("id" => $session_id_team)
				);
				if($update)
				{
					$_SESSION["success_change_info"] = 1;
					$url = home_url()."/manage-group/".$data_query_team->slug;
					wp_redirect($url);
				}
				else
				{
					$_SESSION["success_change_info"] = 2;
					$url = home_url()."/manage-group/".$data_query_team->slug;
					wp_redirect($url);
				}
			}
			else
			{
				$_SESSION["success_change_info"] = 2;
				$url = home_url()."/manage-group/".$data_query_team->slug;
				wp_redirect($url);
			}
        }
        
    }
?>
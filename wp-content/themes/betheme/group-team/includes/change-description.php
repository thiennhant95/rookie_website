<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$table_team = $wpdb->prefix . "team";
    $session_id_team = $_SESSION["branch_id"];
	$query_team = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d",$session_id_team);
	$data_query_team = $wpdb->get_row($query_team);
	$update = $wpdb->update($table_team,
		array(
			"mo_ta" => $_POST["description_group"],
			"slogan" => $_POST["slogan_group"]
		),
		array("id" => $session_id_team)
	);
	if($update){
		$_SESSION["success_description"] = 1;
		$url = home_url()."/manage-group/".$data_query_team->slug;
		wp_redirect($url);
	}
	else{
		$_SESSION["success_description"] = 2;
		$url = home_url()."/manage-group/".$data_query_team->slug;
		wp_redirect($url);
	}
}
?>
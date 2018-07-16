<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$session_id_team = $_SESSION["branch_id"];
	if($_POST["button_id"] != ""){
		$table_order = $wpdb->prefix."order";
		$table_order_detail = $wpdb->prefix."order_detail";
		$query_order = $wpdb->prepare("SELECT * FROM $table_order WHERE id = %d",$_POST["button_id"]);
		$data_query_order = $wpdb->get_row($query_order);
		if($data_query_order != null){
			$update = $wpdb->update($table_order,
				array(
					"order_status" => 3
				),
				array(
					"team_id" => $session_id_team , 
					"id" => $_POST["button_id"]
				)
			);
			if($update){
				$update_detail = $wpdb->update($table_order_detail,
					array(
						"status" => 3
					),
					array(
						"team_id" => $session_id_team , 
						"order_id" => $_POST["button_id"]
					)
				);
			}
		}
	}
}
?>
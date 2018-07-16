<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["post"]) && isset($_POST["type"])){
		$table_post_group = $wpdb->prefix."post_group";
		$table_team_post = $wpdb->prefix."team_post";
		$post = $_POST["post"];
		$type = $_POST["type"];
		$your_post = $_POST["your_post"];
		$session_id_team = $_SESSION["branch_id"];
		$your_post = $_POST["your_post"];
		$query_team_post = $wpdb->prepare("SELECT * FROM $table_team_post WHERE id_team = %d AND id_post = %d AND id = %d", $session_id_team, $post, $your_post);
		$data_team_post = $wpdb->get_row($query_team_post);
		if(!empty($data_team_post)){
			$delete = $wpdb->delete($table_team_post,
				array("id" => $your_post),
				array("%d")
			);
			if($delete){
				$delete_post_group = $wpdb->delete($table_post_group,
					array("id" => $post),
					array("%d")
				);
			}
		}
	}
}
?>
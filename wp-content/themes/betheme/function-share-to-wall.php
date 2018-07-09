<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['share']) && isset($_POST['status'])){
		global $wpdb;
		$table_team_post = $wpdb->prefix."team_post";
		$session_id_team = $_SESSION["branch_id"];
		$insert = $wpdb->insert($table_team_post,
			array(
			'id' => $wpdb->insert_id,
			'id_post' => htmlspecialchars($_POST['share']),
			'id_team' => $session_id_team,
			'status_share' => htmlspecialchars($_POST['status']),
			'post_type' => 2
			),
			array("%d","%s","%d","%s","%d")
		);
		if($insert){
			echo "<div class='col-md-12 text-left alert alert-success'>Bài viết đã được chia sẽ lên trang của bạn</div>";
		}
		else{
			echo "<div class='col-md-12 text-left alert alert-danger'>Không thể chia sẽ bài viết này</div>";
		}
	}
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['product']) && !empty($_POST["product"]) && isset($_POST['id_team']) && !empty($_POST['id_team']))
	{
		$products = json_encode($_POST["product"]);
		$id_team = $_POST['id_team'];
		global $wpdb;
		$table_team = $wpdb->prefix."team";
		$update = $wpdb->update($table_team,
			array('san_pham_nhom' => $products),
			array('id' => $id_team)
		);
		if($update){
			echo "1";
		}
		else{
			echo "0";
		}
	}
	else{
		echo "0";
	}
}
?>
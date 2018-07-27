<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($_POST['district'] != null || $_POST['sum_weight'] != null){
		$table_quanhuyen = $wpdb->prefix."quanhuyen";
		$table_banggia_dhl = $wpdb->prefix."banggia_dhl";
		$query_quanhuyen = $wpdb->prepare("SELECT * FROM $table_quanhuyen WHERE maqh = %s",$_POST['district']);
		$data_quanhuyen = $wpdb->get_row($query_quanhuyen);
		$phan_vung = $data_quanhuyen->phan_vung;
		$weight = round($_POST['sum_weight']/1000,2);
		$query_banggia_dhl = $wpdb->prepare("SELECT * FROM $table_banggia_dhl WHERE phan_vung = %d AND trong_luong = %s",$phan_vung,$weight);
		$data_banggia_dhl = $wpdb->get_row($query_banggia_dhl);
		$sum_ship = $data_banggia_dhl->gia_tien + 5000 + ($data_banggia_dhl->gia_tien + 5000) * 0.1;
		echo $sum_ship;
	} 
}
?>
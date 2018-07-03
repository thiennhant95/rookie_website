<?php
/*
 Template Name: Thông tin nhóm
 */
 ?>
 <?php 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$explode = explode("/",$url_path);
	$team_slug = $explode[1];
	global $wpdb;
	$table_team = $wpdb->prefix."team";
	$data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE slug = %s",$team_slug);
	$data_team = $wpdb->get_row($data_prepare);
	$search = array('\r\n','&lt;br&gt;','\&quot;','\&amp;','\&#039;','\"');
	$replace = array('<br>','<br>','&quot;','&amp;','&#039','"');
	if($data_team != null){
?>
<?php get_header(); ?>
<style>
ul{
	display: block;
	list-style-type: disc;
	-webkit-margin-before: 1em;
	-webkit-margin-after: 1em;
	-webkit-margin-start: 0px;
	-webkit-margin-end: 0px;
	-webkit-padding-start: 40px;
}
li {
    display: list-item;
    text-align: -webkit-match-parent;
}
</style>
	<div id="Content">
		<div class="content_wrapper clearfix">
			<div class="sections_group">
				<div class="col-md-12">
					<div class="col-md-offset-2 col-md-8">
						<div class="col-md-12" style="position: relative; padding: 0">
							<div class="col-md-12" style="background-color:#000; background-image: url('<?php echo $data_team->background; ?>'); background-position: center center; background-repeat: no-repeat; background-size: cover; overflow: hidden; height: 250px; padding: 0px">
							</div>
							<div class="col-md-2 col-xs-4 col-sm-4" style="position: absolute; background-color: #fff; left: 5%; bottom:0; height: 120px; padding:0; width:120px">
								<?php  ?>
									<img src="<?php echo $data_team->logo ?>" style="height: 120px !important; width: 120px !important">
								<?php  ?>
							</div>
							<div class="col-md-8 col-xs-6 col-sm-6" style="position: absolute; right:5%; bottom: 2%; color: #000; text-shadow: 1px 2px 0 #fff, 2px 1px 0 #fff, -1px 2px 0 #fff, -2px 1px 0 #fff, 1px -2px 0 #fff, 2px -1px 0 #fff, -1px -2px 0 #fff, -2px -1px 0 #fff">
								<h3 style="color: #000"><strong><?php echo $data_team->ten_nhom ?></strong></h3>
							</div>
						</div>
						<div class="col-md-12" style="margin-top: 15px; border-radius: 10px; background-color: #f8f8f8; padding-top: 15px">
							<h3><strong>Giới Thiệu</strong></h3><br>
							<span><?php echo str_replace($search,$replace,$data_team->mo_ta); ?></span>
						</div>
						<div class="col-md-12" style="margin-top: 15px; border-radius: 10px; background-color: #f8f8f8; padding-top: 15px">
							<h4><?php echo str_replace($search,$replace,$data_team->slogan); ?></h4>
						</div>
						<div class="col-md-12" style="margin-top: 20px; padding: 0">
							<span style="font-size: 25px"><strong>THÔNG TIN NHÓM</strong></span>
							<table class="table table-bordered table-hover table-responsive">
								<tr>
									<td width="20%"><strong>Trường </strong></td>
									<td width="30%"><?php echo $data_team->truong_hoc ?></td>
									<td width="20%"><strong>Trưởng Nhóm </strong></td>
									<td width="30%"><?php echo $data_team->ten_truong_nhom ?></td>
								</tr>
								<tr>
									<td width="20%"><strong>Số điện thoại </strong></td>
									<td width="30%"><?php echo $data_team->sdt ?></td>
									<td width="20%"><strong>Email </strong></td>
									<td width="30%"><?php echo $data_team->email ?></td>
								</tr>
							</table>
						</div>	
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-offset-2 col-md-8">
						<span style="font-size: 25px"><strong>SẢN PHẨM</strong></span>
					</div>
					<div class="col-md-offset-2 col-md-8" style="margin-top: 20px">
						<?php 
							$arr_products = json_decode($data_team->san_pham_nhom);
							if($arr_products != null)
							{
								foreach($arr_products as $products)
								{
									$table_products = $wpdb->prefix."products";
									$data = "SELECT * FROM $table_products";
									$data_products_prepare = $wpdb->prepare("SELECT * FROM $table_products WHERE id = %d",$products);
									$data_products = $wpdb->get_row($data_products_prepare);
									$arr_image_products = json_decode($data_products->product_images);
									?>
									<div class="col-md-3">
										<div class="col-md-12" style="position: relative">
											<a href="<?php echo home_url()."/group-team/".$team_slug."/san-pham/".$data_products->product_slug; ?>"><img src="<?php echo home_url()."/".$arr_image_products[0] ?>" width="100%" ></a>
											<div class="col-md-12" style="position: absolute; bottom: 0; left: 0;">
												<button type="button" style="width:100%">Thêm Giỏ Hàng</button>
											</div>
										</div>
										<div class="col-md-12 text-center"><a href="<?php echo home_url()."/group-team/".$team_slug."/san-pham/".$data_products->product_slug; ?>"><h3><?php echo $data_products->product_name ?></h3></a></div>
										<div class="col-md-12 text-left" style="font-size: 18px"><span><?php echo $data_products->product_price ?> VND</span></div>
									</div>
									<?php
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<style>
	#Subheader{ display: none; }
</style>
<?php  get_footer(); ?>
<?php 
	} 
	else
	{
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 );
	}
?>
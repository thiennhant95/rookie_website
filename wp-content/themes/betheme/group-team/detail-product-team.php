<?php
/*
 Template Name: Thông tin chi tiết sản phẩm nhóm
 */
 ?>
 <?php 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$explode = explode("/",$url_path);
	$team_slug = $explode[1];
	$check_product_slug = $explode[2];
	$product_slug = $explode[3];
	global $wpdb;
	$table_team = $wpdb->prefix."team";
	$data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE slug = %s",$team_slug);
	$data_team = $wpdb->get_row($data_prepare);
	$table_products = $wpdb->prefix."products";
	$data_prepare_products = $wpdb->prepare("SELECT * FROM $table_products WHERE product_slug = %s",$product_slug);
	$data_products = $wpdb->get_row($data_prepare_products);
	$search = array("\r\n","&lt;br&gt;","\&quot;","\&amp;","\&#039;","\\\\");
	$replace = array("<br>","<br>","&quot;","&amp;","&#039","\\");
	if($data_team != null && $check_product_slug == "san-pham" && $data_products != null)
	{
?>
<?php get_header(); ?>
	<div id="Content">
		<div class="content_wrapper clearfix">
			<div class="sections_group">
				<div class="col-md-12" style="margin-bottom: 20px">
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
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-offset-2 col-md-8" style="margin-top: 20px; margin-bottom: 20px">
						<div class="col-md-4">
							<?php 
								$arr_image_products = json_decode($data_products->product_images);
								?>
								<div class="col-md-12" style="padding:0">
									<img src="<?php echo home_url().'/'.$arr_image_products[0] ?>" width="100%">
									<ul style="margin-top: 30px" class="gallery">
									<?php
										foreach($arr_image_products as $key => $image_products)
										{
											?>
												<li>
													<img src="<?php echo home_url().'/'.$image_products ?>" width="70px">
												</li>
											<?php
										}
									?>
										</ul>
								</div>
						</div>
						<div class="col-md-8">
							<h2><strong><?php echo $data_products->product_name; ?></strong></h2>
							<hr>
							<div><h4><?php echo $data_products->product_price; ?> VND</h4></div>
							<div style="margin:15px 0px"><h4>Số Lượng : </h4><button>-</button><input type="number" class="quantity" min="1" value="1"><button>+</button></div>
							<button type="button">Thêm Giỏ Hàng</button>
							<div style="margin:15px 0px"><strong>Danh mục : </strong></div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-offset-2 col-md-8" style="margin-top: 20px; margin-bottom: 20px">
						<h3><strong>THÔNG TIN SẢN PHẨM</strong></h3>
						<?php if($data_products->product_description){ ?>
						<div class="col-md-12" style="border: 1px solid #000; border-radius: 10px; padding: 20px">
							<?php echo str_replace($search,$replace,$data_products->product_description); ?>	
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<style>
	#Subheader{ display: none; }
	.gallery li{ float: left; margin-left: 15px }
	.quantity { display: inline-block !important; width: 60px !important; font-size: inherit !important;}
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
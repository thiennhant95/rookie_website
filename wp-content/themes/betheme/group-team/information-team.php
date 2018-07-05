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
	$table_post_group = $wpdb->prefix."post_group";
    $table_team_post = $wpdb->prefix."team_post";
    $query_prepare_post_group = $wpdb->prepare("SELECT * FROM $table_post_group INNER JOIN $table_team_post ON $table_post_group.id = $table_team_post.id_post WHERE id_team = %d ORDER BY $table_team_post.id DESC LIMIT 3",$data_team->id);
    $data_post_group = $wpdb->get_results($query_prepare_post_group);
	if($data_team != null){
?>
<?php get_header(); ?>
<style>
.gioi-thieu ul{
	display: block;
	list-style-type: disc;
	-webkit-margin-before: 1em;
	-webkit-margin-after: 1em;
	-webkit-margin-start: 0px;
	-webkit-margin-end: 0px;
	-webkit-padding-start: 40px;
}
.gioi-thieu li {
    display: list-item;
    text-align: -webkit-match-parent;
}
.style-simple table:not(.recaptchatable) th { background: gainsboro; }
.list-team td, .list-team th{ border: 1px solid #fff !important; }
</style>
	<div id="Content" style="background: #e9ebee !important; padding-top: 0 !important">
		<div class="content_wrapper clearfix">
			<div class="sections_group">
				<div class="col-md-12" style="margin-bottom: 20px">
					<div class="col-md-offset-1 col-md-10">
						<div class="col-md-12" style="position: relative; padding: 0">
							<div class="col-md-12" style="background-color:#000; background-image: url('<?php echo $data_team->background; ?>'); background-position: center center; background-repeat: no-repeat; background-size: cover; overflow: hidden; height: 250px; padding: 0px">
							</div>
							<div class="col-md-2 col-xs-4 col-sm-4" style="position: absolute; background-color: #fff; left: 5%; bottom:0; height: 120px; padding:0; width:120px">
								<?php  ?>
									<img src="<?php echo $data_team->logo ?>" style="height: 120px !important; width: 120px !important">
								<?php  ?>
							</div>
							<div class="col-md-8 col-xs-6 col-sm-6" style="position: absolute; right:10%; bottom: 2%; color: #000; text-shadow: 1px 2px 0 #fff, 2px 1px 0 #fff, -1px 2px 0 #fff, -2px 1px 0 #fff, 1px -2px 0 #fff, 2px -1px 0 #fff, -1px -2px 0 #fff, -2px -1px 0 #fff">
								<h3 style="color: #000"><strong><?php echo $data_team->ten_nhom ?></strong></h3>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12" style="padding: 0">
						<div class="col-md-5" style="margin-top: 15px">
							<div class="col-md-12 gioi-thieu" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px">
								<h4><span class="glyphicon glyphicon-globe" style="padding-right: 15px; color: #0CBDE3"></span><strong>Giới thiệu</strong></h4>
								<div class="col-md-12 row">
									<?php
									$trim_mo_ta = wp_trim_words( $data_team->mo_ta, 50);
									echo str_replace($search, $replace,$data_team->mo_ta);
									?>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-12" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-top: 15px">
								<h4><span class="glyphicon glyphicon-bullhorn" style="padding-right: 15px; color: #0CBDE3"></span><strong>Slogan</strong></h4>
								<div class="col-md-12 row">
									<?php
									echo str_replace($search, $replace, $data_team->slogan);
									?>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-12" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-top: 15px">
								<h4><span class="glyphicon glyphicon-pencil" style="padding-right: 15px; color: #0CBDE3"></span><strong>Bài Viết</strong></h4>
								<div class="col-md-12 row" style="margin-top: 15px">
								<?php 
									if(!empty($data_post_group)){ 
                                		foreach($data_post_group as $post_group){
                                ?>
                                <div class="col-md-4">
                                	<img src="<?php echo $post_group->post_group_feature ?>" style="width: 100px !important">
                                </div>
                                <div class="col-md-8">
                                	<a href="<?php echo home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug; ?>"><span style="font-size: 18px"><strong><?php echo $post_group->post_group_title ?></strong></span></a>
                                	<p><?php $wptrim = wp_trim_words($post_group->post_group_content,20,"..."); echo $wptrim; ?></p>
                                	<p class="text-right"><iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug; ?>&layout=button_count&size=small&mobile_iframe=true&width=111&height=20&appId" width="111" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe></p>
                                </div>
                                <hr>
                                <div class="clearfix"></div>
                                <?php
                                		}
                                	}
								?>
								</div>
							</div>
						</div>
						<div class="col-md-7 row" style="margin-top: 15px">	
							<div class="col-md-12 row" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-left: 10px;">
								<h4><span class="glyphicon glyphicon-home" style="padding-right: 15px; color: #0CBDE3"></span><strong>Thông tin nhóm</strong></h4>
								<div class="col-md-12 col-xs-12 col-sm-12 row">
									<table class="table table-striped table-bordered list-team table-reponsive" style="font-size: 13px">
										<thead>
											<tr>
												<th>Họ Tên</th>
												<th>SĐT</th>
												<th>Email</th>
												<th>Chức vụ</th>
											</tr>
										</thead>
										<tbody>
											<tr class="success">
												<td><?php echo $data_team->ten_truong_nhom ?></td>
												<td><?php echo $data_team->sdt_truong_nhom ?></td>
												<td><?php echo $data_team->email_truong_nhom ?></td>
												<td>Trưởng nhóm</td>
											</tr>
											<tr class="info">
												<td><?php echo $data_team->ten_member_1 ?></td>
												<td><?php echo $data_team->sdt_member_1 ?></td>
												<td><?php echo $data_team->email_member_1 ?></td>
												<td>Thành viên</td>
											</tr>
											<tr class="warning">
												<td><?php echo $data_team->ten_member_2 ?></td>
												<td><?php echo $data_team->sdt_member_2 ?></td>
												<td><?php echo $data_team->email_member_2 ?></td>
												<td>Thành viên</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-12 row" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-left: 10px; margin-top: 15px">
								<h4><span class="glyphicon glyphicon-inbox" style="padding-right: 15px; color: #0CBDE3"></span><strong>Sản Phẩm</strong></h4>
								<div class="col-md-12 row">
									<?php 
			                            $table_products = $wpdb->prefix."products";
			                            $query_products = "SELECT * FROM $table_products";
			                            $data_products = $wpdb->get_results($query_products);
			                            $arr_team_product = json_decode($data_team->san_pham_nhom);
			                            $i = 1;
			                        ?>
									<div class="shop-items">
								    	<div class="container-fluid">
								    		<div class="row">
									    <?php
										    $images_url = home_url()."/wp-content/uploads/image-product/";
										    foreach ($data_products as $row):
									        $arr_image_products =json_decode($row->product_images);
									        if(!empty($data_team->san_pham_nhom)){
									        if(in_array($row->id,$arr_team_product)){
								        ?>
								        	<form id="product-<?php echo $i?>" method="post" action="<?php echo home_url('shopping')?>">
								        		<input type="hidden" name="id_team" value="<?php echo $data_team->id ?>">
										        <div class="col-md-3 col-sm-6">
										            <!-- Restaurant Item -->
										            <div class="item">
										                <!-- Item's image -->
										                <img class="img-responsive" src="<?php echo $images_url.$arr_image_products[0] ?>" alt="">
										                <!-- Item details -->
										                <div class="item-dtls">
										                    <!-- product title -->
										                    <h4><a href="<?php echo home_url()."/".$row->product_slug ?>"><?php echo $row->product_name ?></a></h4>
										                    <!-- price -->
										                    <span class="price lblue"><?php echo number_format($row->product_price)."đ" ?></span>
										                </div>
										                <!-- add to cart btn -->
										                <div class="ecom bg-lblue">

										                    <input type="hidden" name="product_id" value="<?php echo $row->id; ?>" />
										                    <?php
										                    	$current_url = base64_encode($_SERVER['REQUEST_URI']);
										                    ?>
										                    <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
										                    <input type="hidden" name="type" value="add">
										                    <a href="javascript:void()" onclick="document.getElementById('product-<?php echo $i?>').submit()" class="btn" href="/shoping-car/"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a>
									                	</div>
									            	</div>
									        	</div>
									        </form>
						        		<?php
						        		$i++; 
							        		}
							        	}
							        		endforeach 
						        		?>
    									</div>
    								</div>
								</div>
							</div>
						</div>
					</div>
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
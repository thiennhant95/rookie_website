<?php
/*
 Template Name: Thông tin chi tiết sản phẩm nhóm
 */
 ?>
 <?php 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$explode = explode("/",$url_path);
	$group_team_slug = $explode[0];
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
	$search = array("\r\n",'&lt;br&gt;','\&quot;','\&amp;','\&#039;','\"');
	$replace = array('<br>','<br>','&quot;','&amp;','&#039','"');
	$table_post_group = $wpdb->prefix."post_group";
    $table_team_post = $wpdb->prefix."team_post";
    $table_post = $wpdb->prefix."posts";
    $query_prepare_post_group = $wpdb->prepare("SELECT * FROM $table_post_group INNER JOIN $table_team_post ON $table_post_group.id = $table_team_post.id_post WHERE id_team = %d AND $table_team_post.post_type = 1 ORDER BY $table_team_post.id DESC LIMIT 3",$data_team->id);
    $query_prepare_post_share = $wpdb->prepare("SELECT * FROM $table_post INNER JOIN $table_team_post ON $table_post.ID = $table_team_post.id_post WHERE id_team = %d AND $table_team_post.post_type = 2 ORDER BY $table_team_post.id DESC LIMIT 3",$data_team->id);
    $data_post_group = $wpdb->get_results($query_prepare_post_group);
    $data_post_share = $wpdb->get_results($query_prepare_post_share);
	if($data_team != null && $check_product_slug == "san-pham" && $data_products != null && $group_team_slug == "group-team")
	{
?>
<style type="text/css" media="screen">
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
@media screen (max-width: 680px)
{	
	.size-custom{ padding-left: 0 !important; padding-right: 0 !important }
}
</style>
<style>
    body{margin-top:20px;
        background:#eee;
    }

    /*panel*/
    .panel {
        border: none;
        box-shadow: none;
    }

    .panel-heading {
        border-color:#eff2f7 ;
        font-size: 16px;
        font-weight: 300;
    }

    .panel-title {
        color: #2A3542;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
        margin-top: 0;
        font-family: 'Open Sans', sans-serif;
    }

    /*product list*/

    .prod-cat li a{
        border-bottom: 1px dashed #d9d9d9;
    }

    .prod-cat li a {
        color: #3b3b3b;
    }

    .prod-cat li ul {
        margin-left: 30px;
    }

    .prod-cat li ul li a{
        border-bottom:none;
    }
    .prod-cat li ul li a:hover,.prod-cat li ul li a:focus, .prod-cat li ul li.active a , .prod-cat li a:hover,.prod-cat li a:focus, .prod-cat li a.active{
        background: none;
        color: #ff7261;
    }

    .pro-lab{
        margin-right: 20px;
        font-weight: normal;
    }

    .pro-sort {
        padding-right: 20px;
        float: left;
    }

    .pro-page-list {
        margin: 5px 0 0 0;
    }

    .product-list img{
        width: 100%;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
    }

    .product-list .pro-img-box {
        position: relative;
    }
    .adtocart {
        background: #fc5959;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        color: #fff;
        display: inline-block;
        text-align: center;
        border: 3px solid #fff;
        left: 45%;
        bottom: -25px;
        position: absolute;
    }

    .adtocart i{
        color: #fff;
        font-size: 25px;
        line-height: 42px;
    }

    .pro-title {
        color: #5A5A5A;
        display: inline-block;
        margin-top: 20px;
        font-size: 16px;
    }

    .product-list .price {
        color:#fc5959 ;
        font-size: 15px;
    }

    .pro-img-details {
        margin-left: -15px;
    }

    .pro-img-details img {
        width: 100%;
    }

    .pro-d-title {
        font-size: 16px;
        margin-top: 0;
    }

    .product_meta {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 10px 0;
        margin: 15px 0;
    }

    .product_meta span {
        display: block;
        margin-bottom: 10px;
    }
    .product_meta a, .pro-price{
        color:#fc5959 ;
    }

    .pro-price, .amount-old {
        font-size: 18px;
        padding: 0 10px;
    }

    .amount-old {
        text-decoration: line-through;
    }

    .quantity {
        width: 120px;
    }

    .pro-img-list {
        width: 90px;
        display: inline-block;
    }

    .pro-img-list a {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .pro-d-head {
        font-size: 18px;
        font-weight: 300;
    }
    .pro-img-list{ cursor: pointer }
    .active-image { border: 3px solid #29E2D7; }
</style>
<?php get_header(); ?>
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
								<h3 style="color: #000"><strong><a href="<?php echo home_url().'/group-team/'.$data_team->slug ?>"><?php echo $data_team->ten_nhom ?></a></strong></h3>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12" style="padding: 0">
							<div class="col-md-5 size-custom" style="margin-top: 15px">
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
								<h4><span class="glyphicon glyphicon-pencil" style="padding-right: 15px; color: #0CBDE3"></span><strong><a href="<?php echo home_url()."/group-team/".$team_slug."/bai-viet/" ?>">Bài Viết</a></strong></h4>
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
							<div class="clearfix"></div>
							<div class="col-md-12" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-top: 15px">
								<h4><span class="glyphicon glyphicon-pencil" style="padding-right: 15px; color: #0CBDE3"></span><strong><a href="<?php echo home_url()."/group-team/".$team_slug."/bai-viet-chia-se/" ?>">Bài Viết Chia Sẽ</a></strong></h4>
								<div class="col-md-12 row" style="margin-top: 15px">
								<?php 
									if(!empty($data_post_share)){ 
                                		foreach($data_post_share as $post_share){
                                ?>
                                <div class="col-md-12" style="border: 1px solid #D9D9D9; border-radius: 10px; margin-bottom: 10px; padding: 15px"><?php echo $post_share->status_share ?></div>
                                <div class="col-md-4">
                                	<?php echo get_the_post_thumbnail($post_share->ID,'thumbnail') ?>
                                </div>
                                <div class="col-md-8">
                                	<a href="<?php echo home_url()."/group-team/".$team_slug."/bai-viet-chia-se/".$post_share->post_name; ?>"><span style="font-size: 18px"><strong><?php echo $post_share->post_title ?></strong></span></a>
                                	<p><?php $wptrim = wp_trim_words($post_share->post_content,20,"..."); echo $wptrim; ?></p>
                                	<p class="text-right"><iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo home_url()."/$post_share->post_name"; ?>&layout=button_count&size=small&mobile_iframe=true&width=111&height=20&appId" width="111" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe></p>
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
							<div class="col-md-7 row size-custom" style="margin-top: 15px">
								<div class="col-md-12 row" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-left: 10px;">
									<h2><strong>Chi Tiết Sản Phẩm</strong></h2>
									<div class="col-md-12 row">
										<iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo home_url()."/group-team/".$team_slug."/san-pham/".$data_products->product_slug; ?>&layout=button_count&size=small&mobile_iframe=true&width=111&height=20&appId" width="111" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
									</div>
									<div class="col-md-12 row">
									    <section class="panel">
									        <div class="panel-body">
									            <div class="col-md-6">
									            	<?php
									            	$images_url = home_url()."/wp-content/uploads/image-product/"; 
									        		$arr_image_product = json_decode($data_products->product_images); 
									        		if(!empty($arr_image_product))
									        		{
									        			$start = 0;
									        			foreach($arr_image_product as $key => $image_product){
									        			if($key == $start){
										        	?>
									                <div class="pro-img-details">
									                    <img src="<?php echo $images_url.$image_product ?>" alt="" id="product-select">
									                </div>
									                <?php 
									                	}
                                                        if($key == $start){
									                ?>
									                <div class="pro-img-list active-image" style="margin-right: 5px">
									                    <span class="thumbnail-img">
									                        <img src="<?php echo $images_url.$image_product ?>" alt="">
									                    </span>
									                </div>
									                <?php 
                                                        }
                                                        else{
                                                    ?>
                                                    <div class="pro-img-list" style="margin-right: 5px">
                                                        <span class="thumbnail-img">
                                                            <img src="<?php echo $images_url.$image_product ?>" alt="">
                                                        </span>
                                                    </div>
                                                    <?php
                                                            }
									                	}
									                }
									                ?>
									            </div>
									            <div class="col-md-6">
									                <h2>
									                    <strong>
									                        <?php echo $data_products->product_name; ?>
									                    </strong>
									                </h2>
									                <p>
									                    <?php  echo str_replace($search, $replace,$data_products->product_description); ?>
									                </p>
									                <div class="m-bot15"> <strong>Price : </strong><span class="pro-price"><?php echo number_format($data_products->product_price)."đ"; ?></span></div>
									                <form id="product-<?php echo $i?>" method="post" action="<?php echo home_url('shopping')?>">
									                	<input type="hidden" name="id_team" value="<?php echo $data_team->id ?>">
									                <div class="form-group">
									                    <label>Số Lượng</label>
									                    <input type="quantiy" placeholder="1" class="form-control quantity" name="product_qty">
									                </div>
									                <p>
									                    <div>
										                    <input type="hidden" name="product_id" value="<?php echo $data_products->id; ?>" />
										                    <?php
										                    	$current_url = base64_encode($_SERVER['REQUEST_URI']);
										                    ?>
										                    <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
										                    <input type="hidden" name="type" value="add">
										                    <button class="btn btn-round btn-danger ecom bg-lblue" type="button" onclick="document.getElementById('product-<?php echo $i?>').submit()" href="/shoping-car/"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</button>
									                	</div>								                
									                </p>
									                </form>
									            </div>
									        </div>
									    </section>
									    <section>
									        <?php echo str_replace($search, $replace, $data_products->product_long_description); ?>
									    </section>
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
	.gallery li{ float: left; margin-left: 15px }
	.quantity { display: inline-block !important; width: 60px !important; font-size: inherit !important;}
</style>
<script>
jQuery(function($){    
    $(".pro-img-list").click(function(){
        $(".pro-img-list").removeClass("active-image");
        $("#product-select").removeAttr("src");
        $(this).addClass("active-image");
        var src = $(this).find("img").attr('src');
        $("#product-select").attr('src',src);
    })
})
</script>
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
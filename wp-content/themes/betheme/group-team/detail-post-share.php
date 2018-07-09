<?php
/*
 Template Name: Trang chi tiết bài viết nhóm
 */
 ?>
 <?php 
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
	$explode = explode("/",$url_path);
	$group_team_slug = $explode[0];
	$team_slug = $explode[1];
	$check_post_slug = $explode[2];
	$post_slug = $explode[3];
	global $wpdb;
	$table_team = $wpdb->prefix."team";
	$data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE slug = %s",$team_slug);
	$data_team = $wpdb->get_row($data_prepare);
	$table_post_group = $wpdb->prefix."post_group";
	$search = array("\r\n",'&lt;br&gt;','\&quot;','\&amp;','\&#039;','\"');
	$replace = array('<br>','<br>','&quot;','&amp;','&#039','"');
	$table_post_group = $wpdb->prefix."post_group";
    $table_team_post = $wpdb->prefix."team_post";
    $table_post = $wpdb->prefix."posts";
    $data_prepare_detail_post_share = $wpdb->prepare("SELECT * FROM $table_post INNER JOIN $table_team_post ON $table_post.ID = $table_team_post.id_post WHERE $table_post.post_name = %s AND id_team = %d AND $table_team_post.post_type = 2",$post_slug , $data_team->id);
	$data_detail_post_share = $wpdb->get_row($data_prepare_detail_post_share);
    $query_prepare_post_group = $wpdb->prepare("SELECT * FROM $table_post_group INNER JOIN $table_team_post ON $table_post_group.id = $table_team_post.id_post WHERE id_team = %d AND $table_team_post.post_type = 1 ORDER BY $table_team_post.id DESC LIMIT 3",$data_team->id);
    $query_prepare_post_share = $wpdb->prepare("SELECT * FROM $table_post INNER JOIN $table_team_post ON $table_post.ID = $table_team_post.id_post WHERE id_team = %d AND $table_team_post.post_type = 2 ORDER BY $table_team_post.id DESC LIMIT 3",$data_team->id);
    $data_post_group = $wpdb->get_results($query_prepare_post_group);
    $data_post_share = $wpdb->get_results($query_prepare_post_share);
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
<?php
	if($data_team != null && $check_post_slug == "bai-viet-chia-se" && $group_team_slug == "group-team")
	{
?>
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
								<h3 style="color: #000"><strong><?php echo $data_team->ten_nhom ?></strong></h3>
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
							<?php if($data_detail_post_share != null && $post_slug != null){ ?>
							<div class="col-md-7 row size-custom" style="margin-top: 15px">
								<div class="col-md-12 row" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-left: 10px;">
									<h2><strong><?php echo $data_detail_post_share->post_title; ?></strong></h2>
									<div class="col-md-12 row">
										<iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo home_url().'/'.$data_detail_post_share->post_name; ?>&layout=button_count&size=small&mobile_iframe=true&width=111&height=20&appId" width="111" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
									</div>
									<div class="col-md-12 row">
										<?php echo str_replace($search, $replace,$data_detail_post_share->post_content); ?>
									</div>
								</div>
							</div>
							<?php 
								}
								else if($post_slug == null){
									$query_all_post_share = $wpdb->prepare("SELECT * FROM $table_post INNER JOIN $table_team_post ON $table_post.ID = $table_team_post.id_post WHERE id_team = %d AND $table_team_post.post_type = 2 ORDER BY $table_team_post.id DESC",$data_team->id);
    								$data_all_post_share = $wpdb->get_results($query_all_post_share);
    								if(!empty($data_all_post_share)){
    								?>
    								<div class="col-md-7 row size-custom" style="margin-top: 15px">
										<div class="col-md-12 row" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-left: 10px;">
											<h3><strong>Tất cả bài viết chia sẽ</strong></h3>
											<?php foreach($data_all_post_share as $all_post_share){ ?>
											<div class="col-md-4">
			                                	<?php echo get_the_post_thumbnail($all_post_share->ID,'thumbnail') ?>
			                                </div>
			                                <div class="col-md-8">
			                                	<a href="<?php echo home_url()."/group-team/".$team_slug."/bai-viet-chia-se/".$all_post_share->post_name; ?>"><span style="font-size: 18px"><strong><?php echo $all_post_share->post_title ?></strong></span></a>
			                                	<p><?php $wptrim = wp_trim_words($all_post_share->post_content,20,"..."); echo $wptrim; ?></p>
			                                	<p class="text-right"><iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo home_url()."/".$all_post_share->post_name; ?>&layout=button_count&size=small&mobile_iframe=true&width=111&height=20&appId" width="111" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe></p>
			                                </div>
			                                <hr>
			                                <div class="clearfix"></div>
			                            <?php } ?>
										</div>
									</div>
    								<?php
    								}
								}
								else{
									?>
									<div class="col-md-7 row size-custom" style="margin-top: 15px">
										<div class="col-md-12 row" style="background: #ffffff; border-radius: 10px; border: 1px solid #F5F5F5;padding: 15px; margin-left: 10px;">
											<div class="col-md-12 alert alert-warning">
												Bài viết không tồn tại
											</div>
										</div>
									</div>
									<?php
								}
							?>
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
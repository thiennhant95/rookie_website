<?php 
ob_start();
function list_manage_video()
{
	if(isset($_GET["page"]) && $_GET["page"] == "list-video"){
		global $wpdb;
		$table_video = $wpdb->prefix . "video_rookie";
		$query_video = "SELECT * FROM $table_video ORDER BY id DESC";
		$data_video = $wpdb->get_results($query_video);
	?>
	<table id="video-list" class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>ID Video</th>
				<th>Tên Video</th>
				<th>Loại Video</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data_video as $video){ ?>
			<tr>
				<td><?php echo $video->id ?></td>
				<td><?php echo $video->video_name ?></td>
				<td>
					<?php 
						if($video->video_type == 0){
							echo "Youtube";
						}
						if($video->video_type == 1){
							echo "Video";
						}
					?>
				</td>
				<td class="text-center">
                    <a href='<?php echo admin_url().'admin.php?page=video-delete&video='.$video->id ?>' title="Are you sure?" class="btn btn-danger btn-flat popovers" data-placement="left"  data-toggle="popover"  data-trigger="focus" data-content="
                                    <div>
                                    <a class='btn btn-flat btn-sm btn-default pull-left' data-trigger='focus'><span class='glyphicon glyphicon-remove'></span></a>&nbsp
                                    <a class='btn btn-flat btn-danger btn-sm pull-right' href='<?php echo admin_url().'video-delete?video='.$video->id ?>' ><span class='glyphicon glyphicon-ok'></span></a>
                                    </div>
                                    " data-html="true"  data-type="Group" onclick="return confirm_delete();">Xóa</a>
                                    <script>function confirm_delete() { return confirm("Bạn có chắc muốn xoá dữ liệu này ?"); }</script>
                </td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<script>
		$(document).ready(function(){
            $("#video-list").DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "pageLength"  : 10
            });
        });
	</script>
	<?php
	}
}

function add_video()
{
	if(isset($_GET["page"]) && $_GET["page"] == "add-video"){
	?>
		<div class="col-md-12">
			<h2>Tạo Video</h2>
		</div>
		<form action="" method="post">
		<div class="col-md-12 margin-top20">
			<label>Tên Video</label>
			<input type="text" name="video_name" class="form-control">
		</div>
		<div class="col-md-12 margin-top20">
			<label>Loại Video</label>
			<input type="radio" name="video_type" value="0" class="video_type"> Youtube
			<input type="radio" name="video_type" value="1" class="video_type"> Upload
		</div>
		<div class="col-md-12 margin-top20" id="url-video" style="display:none">
			<label>Embed Video Youtube</label>
			<input type="text" name="url_youtube" class="form-control url-video">
			<span id="load-youtube"></span>
		</div>
		<div class="col-md-12 margin-top20" id="upload-video" style="display:none">
			<label>Upload Video</label>
		<?php 
			if(function_exists( 'wp_enqueue_media' )){
			    wp_enqueue_media();
			}else{
			    wp_enqueue_style('thickbox');
			    wp_enqueue_script('media-upload');
			    wp_enqueue_script('thickbox');
			}
		?>
			<input type="text" name="upload_video" class="upload_video_upload" hidden="hidden" value="<?php echo get_option('upload_video'); ?>">
				 <iframe src="<?php echo get_option('upload_video'); ?>" name="upload_video" width="300px" height="250px" class="upload_video" id="display_iframe" style="display:none"></iframe>
			<button class="upload_video_upload button button-primary margin-top20">Upload</button>
        </div>
		</div>
		<div class="col-md-12 margin-top20">
			<button type="submit" name="add_video" class="btn btn-primary">Thêm Video</button>
		</div>
		</form>
		<script>
	    jQuery(document).ready(function($) {
	        $('.upload_video_upload').click(function(e) {
	            e.preventDefault();
	            var custom_uploader = wp.media({
	                title: 'Custom Video',
	                button: {
	                    text: 'Upload Video'
	                },
	                multiple: false
	            })
	            .on('select', function() {
	                var attachment = custom_uploader.state().get('selection').first().toJSON();
	                $('.upload_video').attr('src', attachment.url);
	                $('.upload_video_upload').val(attachment.url);
	                $('#display_iframe').css({"display":"block"});
	            })
	            .open();
	        });
	        $(".video_type").change(function(){
	        	var video_type = $(this).val();
	        	if(video_type == 0){
	        		$("#load-youtube").html('');
	        		$("#url-video").css({"display":"block"});
	        		$(".upload_video").attr("src","");
	        		$(".upload_video_upload").val("");
	        		$("#upload-video").css({"display":"none"});
	        	}
	        	if(video_type == 1){
	        		$("#load-youtube").html('');
	        		$("#upload-video").css({"display":"block"});
	        		$(".url-video").val("");
	        		$("#url-video").css({"display":"none"});
	        	}
	        })
	        $(".url-video").change(function(){
	        	var url_video = $(this).val();
	        	$("#load-youtube").html('');
	        	$("#load-youtube").html(url_video);
	        });
    	});
		</script>
	<?php
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		global $wpdb;
		$table_video = $wpdb->prefix . "video_rookie";
		if(!empty($_POST["video_name"]) && $_POST["video_type"] !== null && ($_POST["url_youtube"] !== null || $_POST["upload_video"] !== null))
		{
			$video_name = $_POST["video_name"];
			$video_type = $_POST["video_type"];
			$url_video = "";
			if($_POST["url_youtube"] !== "")
			{
				$url_video = $_POST["url_youtube"];
			}
			if($_POST["upload_video"] !== "")
			{
				$url_video = $_POST["upload_video"];
			}
			$insert = $wpdb->insert($table_video,
				array(
					"id" => $wpdb->insert_id,
					"video_name" => htmlspecialchars($video_name),
					"video_type" => htmlspecialchars($video_type),
					"video_url" => htmlspecialchars($url_video),
					"status" => 1
				),
				array("%d","%s","%s","%s","%d")
			);
			if($insert){
				$url_admin_video = admin_url('admin.php?page=list-video');
				wp_redirect($url_admin_video);
			}
			else{
				echo "<script>alert('Insert Failed')</script>";
			}
		}
	}
}

function delete_manage_video(){
	if(isset($_GET["page"]) && isset($_GET['video']) && $_GET["page"] == "video-delete"){
		global $wpdb;
		$id_video = $_GET["video"];
		$table_video = $wpdb->prefix."video_rookie";
		$query_all_video = "SELECT * FROM $table_video WHERE status = 1";
		$data_all_video = $wpdb->get_results($query_all_video);
		if(count($data_all_video) > 2){
			$delete = $wpdb->delete($table_video , array('id' => $id_video));
			if($delete){
				$url_admin_video = admin_url('admin.php?page=list-video');
				wp_redirect($url_admin_video);
			}
			else{
				$url_admin_video = admin_url('admin.php?page=list-video');
				wp_redirect($url_admin_video);
				echo "<script>alert('Không thể xoá video')</script>";
			}
		}
		else{
			$url_admin_video = admin_url('admin.php?page=list-video');
			wp_redirect($url_admin_video);
			echo "<script>alert('Không thể xoá video')</script>";
		}
	}
}

function plugin_shortcode_video(){
	global $wpdb;
	$table_video = $wpdb->prefix."video_rookie";
	$query_video = "SELECT * FROM $table_video WHERE status = 1 order by id DESC LIMIT 2";
	$data_video =$wpdb->get_results($query_video);
	$search = array('\r\n','&lt;br&gt;','\&quot;','\&amp;','\&#039;','\"','&lt;','&gt;');
	$replace = array('<br>','<br>','"','&amp;','&#039','"','<','>');
    ob_start();
    ?>
    <style>
    	.load_video iframe{ width: 100%; height: 430px !important }
    </style>
    <?php
    foreach($data_video as $video){
    ?>
    <div class="wpb_column vc_column_container vc_col-sm-6 load_video">
    	<div class="vc_column-inner ">
    		<div class="wpb_wrapper">
				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<p>
							<?php 
							if($video->video_type == 0){ 
								echo str_replace($search, $replace,$video->video_url); 
							}
							if($video->video_type == 1){
								?>
								<iframe src="<?php echo $video->video_url ?>"></iframe>
								<?php
							} 
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php
   	}
    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;
}
add_shortcode('shortcode_video', 'plugin_shortcode_video');
?>
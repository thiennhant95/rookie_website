<?php
ob_start(); 
function list_logo_partner(){
	if(isset($_GET["page"]) && $_GET["page"] == "list-partner"){
		global $wpdb;
		$table_logo_partner = $wpdb->prefix . "logo_partner";
		$query_logo_partner = "SELECT * FROM $table_logo_partner ORDER BY id DESC";
		$data_logo_partner = $wpdb->get_results($query_logo_partner);
	?>
	<style>
		#partner-list tr td { vertical-align: middle }
	</style>
	<div class="col-md-12 text-right" style="margin: 20px 0"><a href='<?php echo admin_url().'admin.php?page=partner-create'; ?>'><button type="button" class="btn btn-primary"><strong><span class="glyphicon glyphicon-plus"></span> Create Partner</strong></button></a></div>
	<table id="partner-list" class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Đối Tác</th>
				<th>Website</th>
				<th>Hình Ảnh</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data_logo_partner as $partner){ ?>
			<tr>
				<td><?php echo $partner->partner_name ?></td>
				<td><a href="<?php echo $partner->partner_url; ?>"><?php echo $partner->partner_url; ?></a></td>
				<td><img src="<?php echo $partner->partner_image ?>" width="100px" height="100px"></td>
				<td class="text-center">
					<a href='<?php echo admin_url().'admin.php?page=partner-detail&partner='.$partner->id ?>'><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button></a>
                    <a href='<?php echo admin_url().'admin.php?page=partner-delete&partner='.$partner->id ?>' title="Are you sure?" class="btn btn-danger btn-flat popovers" data-placement="left"  data-toggle="popover"  data-trigger="focus" data-html="true"  data-type="Group" onclick="return confirm_delete();"><span class="glyphicon glyphicon-trash"></span></a>
                    <script>function confirm_delete() { return confirm("Bạn có chắc muốn xoá dữ liệu này ?"); }</script>
                </td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<script>
		$(document).ready(function(){
            $("#partner-list").DataTable({
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

function create_logo_partner(){
	if(isset($_GET["page"]) && $_GET["page"] == "partner-create" && !isset($_GET["partner"])){
	?>
		<div class="col-md-12">
			<h2>Tạo Đối Tác</h2>
		</div>
		<form action="" method="post">
		<div class="col-md-12 margin-top20">
			<label>Đối Tác</label>
			<input type="text" name="partner_name" class="form-control">
		</div>
		<div class="col-md-12 margin-top20" id="url-logo">
			<label>Website</label>
			<input type="text" name="partner_url" class="form-control">
		</div>
		<div class="col-md-12 margin-top20" id="upload-logo">
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
			<input type="text" name="upload_logo" class="upload_logo_upload" hidden="hidden" value="<?php echo get_option('upload_logo'); ?>">
			<div class="col-md-12" style="padding-left: 0px;">
				<img src="<?php echo get_option('upload_logo'); ?>" name="upload_logo" width="150px" height="150px" class="upload_logo">
			</div>
			<div class="col-md-12" style="padding-left: 0px; margin: 10px 0px">
				<button class="upload_logo_upload button button-primary margin-top20">Upload</button>
			</div>
        </div>
		</div>
		<div class="col-md-12 margin-top20">
			<button type="submit" name="create_partner" class="btn btn-primary">Thêm</button>
		</div>
		</form>
		<script>
	    jQuery(document).ready(function($) {
	        $('.upload_logo_upload').click(function(e) {
	            e.preventDefault();
	            var custom_uploader = wp.media({
	                title: 'Custom Logo',
	                button: {
	                    text: 'Upload Logo'
	                },
	                multiple: false
	            })
	            .on('select', function() {
	                var attachment = custom_uploader.state().get('selection').first().toJSON();
	                $('.upload_logo').attr('src', attachment.url);
	                $('.upload_logo_upload').val(attachment.url);
	            })
	            .open();
	        });
	    });
	    </script>    
	<?php
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		global $wpdb;
		$table_logo_partner = $wpdb->prefix . "logo_partner";
		if(!empty($_POST["partner_name"]) && !empty($_POST["partner_url"]) && !empty($_POST["upload_logo"]))
		{
			$partner_name = $_POST["partner_name"];
			$partner_url = $_POST["partner_url"];
			$partner_image = $_POST["upload_logo"];
			$insert = $wpdb->insert($table_logo_partner,
				array(
					"id" => $wpdb->insert_id,
					"partner_name" => htmlspecialchars($partner_name),
					"partner_url" => htmlspecialchars($partner_url),
					"partner_image" => htmlspecialchars($partner_image),
				),
				array("%d","%s","%s","%s")
			);
			if($insert){
				$url_admin_partner = admin_url('admin.php?page=list-partner');
				wp_redirect($url_admin_partner);
			}
			else{
				echo "<script>alert('Insert Failed')</script>";
			}
		}
	}
}

function detail_logo_partner(){
	if(isset($_GET["page"]) && $_GET["page"] == "partner-detail" && isset($_GET["partner"]) && !empty($_GET["partner"])){
		global $wpdb;
		$table_logo_partner = $wpdb->prefix . "logo_partner";
		$query_logo_partner = $wpdb->prepare("SELECT * FROM $table_logo_partner WHERE id = %d",$_GET["partner"]);
		$logo_partner = $wpdb->get_row($query_logo_partner);
	?>
		<div class="col-md-12">
			<h2>Thông tin chi tiết</h2>
		</div>
		<form action="" method="post">
		<div class="col-md-12 margin-top20">
			<label>Đối Tác</label>
			<input type="text" name="partner_name" class="form-control" value="<?php echo $logo_partner->partner_name ?>">
		</div>
		<div class="col-md-12 margin-top20" id="url-logo">
			<label>Website</label>
			<input type="text" name="partner_url" class="form-control" value="<?php echo $logo_partner->partner_url ?>">
		</div>
		<div class="col-md-12 margin-top20" id="upload-logo">
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
			<input type="text" name="upload_logo" class="upload_logo_upload" hidden="hidden" value="<?php echo $logo_partner->partner_image ?><?php echo get_option('upload_logo'); ?>">
			<div class="col-md-12" style="padding-left: 0px;">
				<img src="<?php echo $logo_partner->partner_image ?><?php echo get_option('upload_logo'); ?>" name="upload_logo" width="150px" height="150px" class="upload_logo">
			</div>
			<div class="col-md-12" style="padding-left: 0px; margin: 10px 0px">
				<button class="upload_logo_upload button button-primary margin-top20">Upload</button>
			</div>
        </div>
		</div>
		<div class="col-md-12 margin-top20">
			<button type="submit" name="detail_partner" class="btn btn-primary">Cập Nhật</button>
		</div>
		</form>
		<script>
	    jQuery(document).ready(function($) {
	        $('.upload_logo_upload').click(function(e) {
	            e.preventDefault();
	            var custom_uploader = wp.media({
	                title: 'Custom Logo',
	                button: {
	                    text: 'Upload Logo'
	                },
	                multiple: false
	            })
	            .on('select', function() {
	                var attachment = custom_uploader.state().get('selection').first().toJSON();
	                $('.upload_logo').attr('src', attachment.url);
	                $('.upload_logo_upload').val(attachment.url);
	            })
	            .open();
	        });
	    });
	    </script>    
	<?php
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		global $wpdb;
		$table_logo_partner = $wpdb->prefix . "logo_partner";
		if(!empty($_POST["partner_name"]) && !empty($_POST["partner_url"]) && !empty($_POST["upload_logo"]))
		{
			$partner_name = $_POST["partner_name"];
			$partner_url = $_POST["partner_url"];
			$partner_image = $_POST["upload_logo"];
			$update = $wpdb->update($table_logo_partner,
				array(
					"partner_name" => htmlspecialchars($partner_name),
					"partner_url" => htmlspecialchars($partner_url),
					"partner_image" => htmlspecialchars($partner_image),
				),
				array("id" => $_GET["partner"] ),
				array("%s","%s","%s"),
				array("%d")
			);
			if($update){
				$url_admin_partner = admin_url('admin.php?page=list-partner');
				wp_redirect($url_admin_partner);
			}
			else{
				echo "<script>alert('Cập nhật thất bại')</script>";
			}
		}
	}
}

function delete_logo_partner(){
	if(isset($_GET["page"]) && isset($_GET['partner']) && $_GET["page"] == "partner-delete" && !empty($_GET["partner"])){
		global $wpdb;
		$id_partner = $_GET["partner"];
		$table_logo_partner = $wpdb->prefix."logo_partner";
		$delete = $wpdb->delete($table_logo_partner , array('id' => $id_partner));
		if($delete){
			$url_admin_video = admin_url('admin.php?page=list-partner');
			wp_redirect($url_admin_video);
		}
		else{
			$url_admin_video = admin_url('admin.php?page=list-partner');
			wp_redirect($url_admin_video);
			echo "<script>alert('Không thể xoá đối tác')</script>";
		}
	}
}

function plugin_shortcode_logo_partner(){
	global $wpdb;
	$table_logo_partner = $wpdb->prefix."logo_partner";
	$query_logo_partner = "SELECT * FROM $table_logo_partner ";
	$data_logo_partner = $wpdb->get_results($query_logo_partner);
	$search = array('\r\n','&lt;br&gt;','\&quot;','\&amp;','\&#039;','\"','&lt;','&gt;');
	$replace = array('<br>','<br>','"','&amp;','&#039','"','<','>');
    ob_start();
    ?>
    <div class="col-md-12 col-xs-12 col-sm-12">
	  <div class="col-md-12 col-sm-12 col-xs-12 autoplay">
    <?php
    foreach($data_logo_partner as $logo_partner){
    ?>
	  	<div class="col-md-2 col-sm-4 col-xs-6">
	  		<img src="<?php echo $logo_partner->partner_image; ?>" width="100%">
	  	</div>
    <?php
   	}
   	?>
   		</div>
	</div>
   	<?php
    $list_logo_partner = ob_get_contents();
    ob_end_clean();
    return $list_logo_partner;
}
add_shortcode('shortcode_logo_partner', 'plugin_shortcode_logo_partner');
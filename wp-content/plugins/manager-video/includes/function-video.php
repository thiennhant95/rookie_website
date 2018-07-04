<?php 
function list_manage_video()
{
	if(isset($_GET["page"]) && $_GET["page"] == "list-video")
	{
		?>
		<table class="table table-responsive table-hover table-bordered table-striped">
			<thead>
				<tr>ID Video</tr>
				<tr>Tên Video</tr>
				<tr>Loại Video</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<?php
	}
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$flag = 0;
	if(isset($_POST["post"]) && isset($_POST["type"])){
		$table_post_group = $wpdb->prefix."post_group";
		$table_team_post = $wpdb->prefix."team_post";
		$table_post = $wpdb->prefix."posts";
		$post = $_POST["post"];
		$type = $_POST["type"];
		$your_post = $_POST["your_post"];
		$session_id_team = $_SESSION["branch_id"];
		$your_post = $_POST["your_post"];
		$arr_data = array();
		$query_team_post = $wpdb->prepare("SELECT * FROM $table_team_post WHERE id_team = %d AND id_post = %d AND id = %d", $session_id_team, $post, $your_post);
		$data_team_post = $wpdb->get_row($query_team_post);
		if(!empty($data_team_post)){
			$delete = $wpdb->delete($table_team_post,
				array("id" => $your_post),
				array("%d")
			);
			if($delete && $type == 1){
				$delete_post_group = $wpdb->delete($table_post_group,
					array("id" => $post),
					array("%d")
				);
				$flag = 1;
			}
			if($flag == 1){
				$query_prepare_post_group = $wpdb->prepare("SELECT $table_team_post.*, $table_post_group.post_group_title, $table_post_group.post_group_slug, $table_post_group.post_group_content, $table_post_group.post_group_feature, $table_post_group.post_group_status, $table_post_group.post_group_date FROM $table_post_group INNER JOIN $table_team_post ON $table_post_group.id = $table_team_post.id_post WHERE post_type = 1 AND id_team = %d",$_SESSION["branch_id"]);
                $data_post_group = $wpdb->get_results($query_prepare_post_group);
                $data = '';
                if(!empty($data_post_group)){ 
                    foreach($data_post_group as $post_group){
                    	$data .= '<tr>
                                    <td><img src="'.$post_group->post_group_feature .'" style="width: 100px !important"></td>
                                    <td>'.$post_group->post_group_title.'</td>';
                        $wptrim = wp_trim_words($post_group->post_group_content,20,"...");
                        $data .= '<td>'.$wptrim.'</td>
                                    <td><a href="'.home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug.'">'.home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug.'</a></td>
                                    <td><button type="button" class="btn btn-danger" name="btnXoa" data-btn-xoa="'.$post_group->id_post.'" data-type="1" data-post="'.$post_group->id.'">Xoá</button></td>
                                </tr>';
                    }
                }
                $arr_data[] = $flag;
                $arr_data[] = $data;
                echo json_encode($arr_data); 
			}
			else{
				$query_prepare_post_share = $wpdb->prepare("SELECT * FROM $table_team_post INNER JOIN $table_post ON $table_team_post.id_post = $table_post.ID WHERE $table_team_post.post_type = 2 AND id_team = %d",$_SESSION["branch_id"]);
                $data_post_share = $wpdb->get_results($query_prepare_post_share);
                 $data = '';
                if(!empty($data_post_share)){ 
                    foreach($data_post_share as $post_share){
                    	$data .= '<tr>
                                    <td>'.get_the_post_thumbnail($post_share->ID,'thumbnail').'</td>
                                    <td>'.$post_share->post_title.'</td>';
                        $wptrim = wp_trim_words($post_share->post_content,20,"...");
                        $data .= '<td>'.$wptrim.'</td>
                                    <td><a href="'.home_url()."/group-team/".$team_slug."/bai-viet-chia-se/".$post_share->post_name.'/">'.home_url()."/group-team/".$team_slug."/bai-viet/".$post_group->post_group_slug.'</a></td>
                                    <td><button type="button" class="btn btn-danger" name="btnXoa" data-btn-xoa="'.$post_share->id_post.'" data-type="2" data-post="'.$post_share->id.'">Xoá</button></td>
                                </tr>';
                    }
                }
                $arr_data[] = $flag;
                $arr_data[] = $data;
                echo json_encode($arr_data);
			}
		}
	}
}
?>
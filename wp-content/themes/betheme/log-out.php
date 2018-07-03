<?php 
session_unset("branch_id");
session_unset("branch_slug");
$url = home_url();
wp_redirect($url);
?>
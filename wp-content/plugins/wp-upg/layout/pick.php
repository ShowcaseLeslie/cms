<?php
$options = get_option('upg_settings');

$popup=$options['global_popup'];
if(isset($params['popup'])) $popup = $params['popup'];


if(isset($params['layout']))
	$layout=trim($params['layout']);
else
	$layout=$options['global_layout'];


if(isset($params['id'])) 
	$post_id =get_post( $params['id'] );

if(isset($params['notice'])) 
	$notice ="<p>".$params['notice']."</p>";
else
	$notice="";
	

$put="";
ob_start ();

if($post_id)
{
	
	$thetitle=$post_id->post_title;
	$permalink=get_permalink($post_id->ID);
	$image=upg_image_src('thumbnail',$post_id);
	$image_large=upg_image_src('large',$post_id);
	
	if(upg_isVideo($post_id))
	{
		$preview_large=upg_video_preview_url(upg_isVideo($post_id));
		$preview_type='youtube';
	}
	else
	{
		$preview_large=$image_large;
		$preview_type='wp-upg';
	}
	
	if(file_exists(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_pick.php"))
	include(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_pick.php");
	else
	echo __('Pick Layout Not Found.','wp-upg').": ".$layout."_pick.php";
	
}
else
{
	echo __('Post Not found.','wp-upg');
}

$put=ob_get_clean (); 
return $put;

?>
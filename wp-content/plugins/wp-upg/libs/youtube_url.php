<?php
$all_upg_extra= get_post_custom($post->ID);
	
	if(isset($all_upg_extra["youtube_url"][0]))
			$youtube_url=$all_upg_extra["youtube_url"][0];
			else	
			$youtube_url="";
		
		if(isset($all_upg_extra["youtube_url"][0]))
		{		
			echo '<b>Enter Full Youtube/Vimeo URL :</b><input type="url" name="youtube_url" size="75" id="youtube_url"  value="'.$all_upg_extra["youtube_url"][0].'">';
			
			echo '<br><br><a href="'.$all_upg_extra["youtube_url"][0].'" target="_blank"><img src="'.upg_getimg_youtube($all_upg_extra["youtube_url"][0]).'"></a>';
		}
		else
		{
			echo '<b>Enter Full Youtube/Vimeo URL : </b><input type="text" name="youtube_url" size="75"   id="youtube_url"  value="">';
		}
?>
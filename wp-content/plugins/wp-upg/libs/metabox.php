<?php
//Adding meta boxes Main Image
	function upg_meta_boxes()
	{
		$prefix = 'upg_';

		$meta_boxes = array(
				'post_img'=>array('id'=> $prefix.'image','title'=>__('Main Image/Youtube','wp-upg'),'callback'=>'upg_meta_box_image','position'=>'advanced','priority'=>'high'),
				
				'upg-layout'=>array('title'=>__('Post Preview Layout',"wp-upg"),'callback'=>'upg_meta_box_layout','position'=>'side','priority'=>'core'),
				
				'upg-extra-fields'=>array('title'=>__('Extra Custom Fields',"wp-upg"),'callback'=>'upg_meta_box_extra_field','position'=>'side','priority'=>'core'),
			);

			
			 

			$meta_boxes = apply_filters("upg_meta_box", $meta_boxes);
			foreach($meta_boxes as $id=>$meta_box)
			{
				extract($meta_box);
				add_meta_box($id, $title, $callback,'upg', $position, $priority);
			}    
			
			
			
	}
	
	function upg_meta_box_extra_field($post)
	{
		$all_upg_extra= get_post_custom($post->ID);
		$options = get_option('upg_settings');
			
		
		//Display 5 custom fields loop
		for ($x = 1; $x <= 5; $x++) 
		{
			if(isset($all_upg_extra["upg_custom_field_".$x][0]))
			$upg_custom_field[$x]=$all_upg_extra["upg_custom_field_".$x][0];
			else	
			$upg_custom_field[$x]="";
			if($options['upg_custom_field_'.$x.'_show']=='on')
			{
				if($options['upg_custom_field_type_'.$x]=='checkbox')
				{
					?>
					<?php echo $options['upg_custom_field_'.$x]; ?>:  
					<input type="checkbox" name="upg_custom_field_<?php echo $x; ?>" value="<?php echo 'upg_custom_field_'.$x.'_checked'; ?>" 
					
					<?php if(!empty($upg_custom_field[$x]) && $upg_custom_field[$x]==$upg_custom_field[$x]) 
						echo 'checked';	?> ><hr>
					<?php
				}
				else
				{
			?>
			
			<?php echo $options['upg_custom_field_'.$x]; ?><br> <input type="text" name="upg_custom_field_<?php echo $x; ?>" value="<?php echo $upg_custom_field[$x]; ?>"><br><br>
			
			<?php
				}
			}
		}
		
	}
	
	//Image upload in post type
	 function upg_meta_box_image($post)
	{     ?>
			<script>
		jQuery(document).ready(function($){
			   $("#tabs").tabs();
		});
		  </script>
	
	<div id="tabs">
	<ul>
		
        <li><a href="#tab-1"><?php echo __("Upload Image","odudeshop");?></a></li>
       
		<li><a href="#tab-2"><?php echo __("Post Youtube/Vimeo URL","odudeshop");?></a></li> 
		
				
	</ul>
	 <div id="tab-1">
		<?php include(dirname(__FILE__).'/post_img.php'); ?>
	 </div>
	 <div id="tab-2">
		<?php include(dirname(__FILE__).'/youtube_url.php'); ?>
	 </div>
	 </div>
	 

        
<?php
    }

	?>
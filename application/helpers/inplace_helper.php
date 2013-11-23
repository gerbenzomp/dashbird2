<?php


function blokje($name, $part,  $page=0){
	
	$CI =& get_instance();
	
	if(is_numeric($name)){
		
		$CI->db->where('blog', $CI->session->userdata('blog'));
		$CI->db->where('id', $name); 
		if($page==1){
			$CI->db->where('anchor_page', $CI->session->userdata('curpage'));
		}
		
	}
	else{
		
		$CI->db->where('blog', $CI->session->userdata('blog'));
		$CI->db->where('anchor', $name); 
		if($page==1){
			$CI->db->where('page', $CI->session->userdata('curpage'));
		}
		
		
	}
	
	
	
	
	
	$CI->db->limit(1);
	$q=$CI->db->get('posts');
	if($q->num_rows()>0){
	$data = $q->row();
	
	if($CI->session->userdata('logged_in')){
	?>
	 <span id="anchor-<?=$data->id;?>" class="edit <?=$part;?>">
	<?php
	}
	
	if($data->$part!=''){
	echo  $data->$part;
	}
	elseif($CI->session->userdata('logged_in'))
	{
	echo "(edit)";	
	}
	
	
	if($CI->session->userdata('logged_in')){
	?>
    </span>
    <?php
	}
	}
	else
	{
		if($CI->session->userdata('logged_in')){
		 ?>
		<span id="anchor-<?=$name;?>" class="edit <?=$part;?>">(edit)</span>
        <?php
		}
	}
	
	
}



function blokje_image($name, $width, $height='', $page=0){
	
	if(debug()){
	error_reporting(1);	
	}
	
	
	$CI =& get_instance();
	
	$CI->db->where('blog', $CI->session->userdata('blog'));
	$CI->db->where('anchor', $name); 
	if($page==1){
		$CI->db->where('anchor_page', $CI->session->userdata('curpage'));
	}
	$CI->db->limit(1);
	$q=$CI->db->get('posts');
	if($q->num_rows()>0){
	$data = $q->row();
	
	$CI->db->where('files_id', $data->files_id);
	$CI->db->order_by('order_id');
	$CI->db->limit(1);
	$q2=$CI->db->get('files');
	
		if($q2->num_rows()>0){
		$img = $q2->row();
		
				if($CI->session->userdata('logged_in')){
			?>
			 <span id="anchor-<?=$data->id;?>" class="anchor-gallery">
			<?php
			}
			?>
			<img src="<?=base_url();?>uploads/thumb.php?src=<?=$CI->session->userdata('blog');?>/<?=$img->filename;?>&w=<?=$width;?><?php if($height!=''){ ?>&h=<?=$height;?>&zc=1<?php } ?>" border="0" />
            <?php
			if($CI->session->userdata('logged_in')){
			?>
			</span>
			<?php
			}
		
		
		}
		else
		{
			
			if($CI->session->userdata('logged_in')){
			?>
			 <span id="anchor-<?=$data->id;?>" class="anchor-gallery" style="width: <?=$width;?>px; height: <?=$height;?>px; border: 1px dashed #CCC;">
			<?php
			}
			if($CI->session->userdata('logged_in')){
			?>
			</span>
			<?php
			}
					
			
		}
	
	
	}
	else
	{
		if($CI->session->userdata('logged_in')){
			?>
			 <span id="anchor-<?=$name;?>" class="anchor-create-gallery" style="width: <?=$width;?>px; height: <?=$height;?>px; border: 1px dashed #CCC;">
			<?php
			}
			if($CI->session->userdata('logged_in')){
			?>
			</span>
			<?php
			}
					
	}
	
	
}


function blokje_background($name, $mode='load', $page=0){
	
	if(debug()){
	error_reporting(1);	
	}
	
	
	$CI =& get_instance();
	
	$CI->db->where('blog', $CI->session->userdata('blog'));
	$CI->db->where('anchor', $name); 
	if($page==1){
		$CI->db->where('anchor_page', $CI->session->userdata('curpage'));
	}
	$CI->db->limit(1);
	$q=$CI->db->get('posts');
	if($q->num_rows()>0){
	$data = $q->row();
	
	$CI->db->where('files_id', $data->files_id);
	$CI->db->order_by('order_id');
	$CI->db->limit(1);
	$q2=$CI->db->get('files');
	
		if($q2->num_rows()>0){
		$img = $q2->row();
		
			
			if($mode=='full'){
			 return base_url()."uploads/".$CI->session->userdata('blog')."/".$img->filename;
			}
			elseif($mode=='load'){
			 return base_url()."uploads/load.php?src=".$CI->session->userdata('blog')."/".$img->filename;
			}
			else
			{
			return 	$img->filename;
			}
		
		
		
		}
		else
		{
			
			return "";
					
			
		}
	
	
	}
	else
	{
			return "";
	}
	
	
}




function blokje_fetch($name, $field){
	
	$CI =& get_instance();
	$CI->db->where('blog', $CI->session->userdata('blog'));
	$CI->db->where('anchor', $name); 
	$CI->db->limit(1);
	$q=$CI->db->get('posts');
	
	$blokje =  $q->row();
	
	return $blokje->$field;
	
	
	
}


?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_Upload $upload
 */

class Ajax_upload extends MX_Controller
{

    public $view_data = array();
    private $upload_config;

    function __construct()
    {
        parent::__construct();
    }

    public function uploader($id)
    {
		$data['id'] = $id;
      
        $this->load->view('uploader', $data);
    }

    public function do_upload($blog, $post_id)
    {
        $this->load->library('upload');
		
		
		
		
        $image_upload_folder = FCPATH . '/uploads/'.$blog."/"; // this one is created by default
		$image_large_folder = FCPATH . '/uploads/'.$blog."/large/";  // this one is created by default
		$image_square_folder = FCPATH . '/uploads/'.$blog."/square/";  // this one is created by default
		
		
		 if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }
		
		if (!file_exists($image_large_folder)) {
            mkdir($image_large_folder, DIR_WRITE_MODE, true);
        }
		
		if (!file_exists($image_square_folder)) {
            mkdir($image_square_folder, DIR_WRITE_MODE, true);
        }
		
		
		// optional folders (site config)
		$image_mega_folder = FCPATH . '/uploads/'.$blog."/mega/";
		$image_medium_folder = FCPATH . '/uploads/'.$blog."/medium/";
		$image_small_folder = FCPATH . '/uploads/'.$blog."/small/";
		
			
		
		
		// custom image sizes
		$thm = themePrefs($blog);
		if(isset($thm['image_sizes'])){
			
			
			foreach ($thm['image_sizes'] as $key=>$value) {
				
				if (!file_exists(FCPATH . '/uploads/'.$blog."/".$key."/")) {
				mkdir(FCPATH . '/uploads/'.$blog."/".$key."/", DIR_WRITE_MODE, true);
				
				}
				
			}
			
		}
		

  

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|gif',
            'max_size'      => 10240, // 10 MB
            'remove_space'  => TRUE,
            'encrypt_name'  => TRUE,
			
        );
		


        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
			
			 $file_info = $this->upload->data();
            $upload_error = $this->upload->display_errors();
			
			
			
          	echo '{"status":"error","message":"'.$upload_error.'. Filetype: '.$file_info['file_type'].'"}';
			
        } else {
			
		
			
            $file_info = $this->upload->data();
            // echo json_encode($file_info);
			
			// pr($file_info);
			
			//echo '{"status":"success"}';
			
			// Get the images size
			$picloc = $file_info['file_name'];
			
		
			list($width, $height, $type, $attr)= getimagesize($image_upload_folder.$picloc); 
				
				
		
		
			
			// don't resize images smaller than 900px;
			if($width<900){	
			
			
						
					// if we need retina sizes, let's just upscale...
					if(isset($thm['image_sizes'])){
						
						$image_sizes = $thm['image_sizes'];
					
					}
					else	// otherwise, just leave it the size it is
					{
						
						$image_sizes = array(
						'large' => array($width, 1200)
						);	
			
					}
			
					
			}
			else
			{
				
							
					if(isset($thm['image_sizes'])){
						
						$image_sizes = $thm['image_sizes'];
					
					}
					else
					{
						
						$image_sizes = array(
						//'small' => array(200, 200),
						// 'medium' => array(400, 600),
						'large' => array(900, 1200)
						);	
						
					}
		
			}
	
		
		
		
			
			$this->load->library('image_lib');
			foreach ($image_sizes as $key=>$value) {
				
				
				// fix for iPhone orientation
				$imgdata=@exif_read_data($image_upload_folder.$picloc, 'IFD0');
				
				
				
				//quickMail('upload debug', $imgdata['Orientation']);
				
				
				$angle = 0;
				
				if(isset($imgdata['Orientation'])){
				switch($imgdata['Orientation']) {
                    case 3:
                        $angle=180;
                        break;
					
                    case 6:
                         $angle=270;
                        break;
						
                    case 8:
                        $angle=90;
                        break;
						
                }
				}
			
				
			
				
			
				$config = array(
				$config['image_library'] = 'ImageMagick',
				$config['library_path'] = '/usr/bin/',
					'source_image' => $image_upload_folder.$picloc,
					'new_image' => $image_upload_folder . $key ."/",
					'quality' => '100%',
					'maintain_ratio' => true,
					'width' => $value[0],
					'height' => $value[1],
					'rotation_angle' => $angle,
					
					
				);
			
		
				
		
		
        
		
		
			
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// rotate images
				if($angle!=0){
				$this->image_lib->rotate();
				}
				
				
				$this->image_lib->clear();
			}
			
			unset($config);
			
			
			// square thumb
			
			 $thumblink = $image_small_folder.$picloc;
     // create_square_image($picloc, 125);
	 
	 resize_image($picloc, $picloc, 110, 110);
	//  resize_image($picloc, $picloc, 50, 50);
	 
	  /*          
    //crop thumbnail
    $config['image_library'] = 'gd2';
    $config['source_image'] = $thumblink;
	$config['new_image'] = $image_square_folder.$picloc;
    $config['width'] = 100;
    $config['height']=100;
    $config['x_axis']=20;
    $config['y_axis']=10;
    $config['maintain_ratio'] = FALSE;
                
    $this->image_lib->initialize($config);
    $crop_thumbnail = $this->image_lib->crop();
        
    if ( ! $crop_thumbnail)
    {
        echo $this->image_lib->display_errors();
    }  
			
	$this->image_lib->clear();	
	*/
	
	$title = $file_info['orig_name'];
	$title = str_replace('_', ' ', $title);
	$title = str_replace('-', ' ', $title);
	
	$title = explode('.', $title);
	$title = $title[0];
	
	
	
			
			$data = array('filename'=>$file_info['file_name'], 'title'=>$title, 'post_id'=>$post_id, 'blog'=>$blog, 'category'=>'gallery');
			$this->db->insert('files', $data);
			
			
			$insert_id = mysql_insert_id();
	
	
			
			if($file_info['is_image']){
				$type = 'image';
			}
			else
			{
			$type = 'file';	
			}
			
				
			echo '{"status":"success","filename":"'.$file_info['file_name'].'","filetype":"'.$type.'","file_id":"'.$insert_id.'"}';
			
			
			
			// delete the original file
			@unlink($image_upload_folder.$picloc);
				
			
			
        }

    }
	
	function edit($id){
		
		$this->db->where('id', $id);
		$q=$this->db->get('files');
		
		$item=$q->row();
		
		?>
        
          <header id="modal-label"><h4>Edit Image</h4></header>
          <br />
        <div class="modal-content">  
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="130" valign="top"> 
     <?php if($this->agent->is_mobile()){ ?>  
  <img src="<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/square/<?=$item->filename;?>" />
  
  <?php }else{
	  
	  if($item->placeholder!=''){
	  
	   ?>
   <img src="<?=base_url();?>uploads/thumb.php?src=<?=$item->placeholder;?>&w=200" width="200" style="margin-right: 10px;" />
  
  <?php
	  }
	  else{ ?>
      
      <img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/large/<?=$item->filename;?>&w=200" width="200" style="margin-right: 10px;" />
   
      
   <?php }
   
  }
    ?>
    
  </td>
    <td valign="top">
    
    
   <?php if($this->agent->is_mobile()){ ?> 
    <input class="input-small" type="text" value="<?=$item->title;?>" placeholder="Image title" id="image-title" /><br />
    
    <?php }else{ ?>
    
     <input class="input-xlarge" type="text" value="<?=$item->title;?>" placeholder="Image title" id="image-title" /><br />
     
    <textarea rows="5" style="width: 95%;" id="image-description"><?=$item->description;?></textarea>
    
    <?php } ?>
    
  
   
    </td>
  </tr>
</table></div>


        <footer> 
        <br />
        
        <a style="float: left;" class="btn btn-danger modal-close" onclick='$.ajax({url: "<?=base_url();?>upload/delete/<?=$item->id;?>",context: document.body}).done(function(){$("#page_<?=$item->id?>").fadeOut("slow");});'>Delete</a></footer>
       
       
         <a style="float: right;" class="btn modal-close btn-success" onclick='$.ajax({type:"POST",url:"<?=base_url();?>upload/save_title2/<?=$item->id;?>",data:{value: $("#image-title").val(), description: $("#image-description").val()}, context: document.body}).done(function(){  });$("#modal-close").click();'>Save</a> 
       
		<?php
	}
	
	

	function list_files($post_id){
	
	?>
    
    




<div style="clear: both;"></div>
<div id="upload-list">


<ul class="ui-sortable upload-list" id="sortable-uploads" style="list-style-type: none; margin: 0; padding: 0; margin-top: 5px;">

<?php

$this->db->where('blog', $this->session->userdata('blog'));
$this->db->where('post_id', $post_id);
$this->db->order_by('order_id');
$q2=$this->db->get('files');



foreach($q2->result() as $item){
	
	
	?><li class="sortable-item" id="page_<?=$item->id;?>">
 <?php if($item->placeholder!=''){ ?>
<img src="<?=base_url();?>uploads/thumb.php?src=<?=$item->placeholder;?>&w=110&h=110&zc=1" style="display: block;" />

<?php }elseif($item->s3!=''){ ?>
<img src="http://www.uploadcdn.com/thumb.php?src=blogbird/<?=$this->session->userdata('blog');?>/<?=$item->s3;?>&w=110&h=110&zc=1" style="display: block;" />
<?php }else{ ?>
    <img src="<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/square/<?=$item->filename;?>" style="display: block;" />
    <?php } ?>
      
    
      
      <a onclick="$('#details').load('<?=base_url();?>ajax_upload/edit/<?=$item->id;?>');" data-reveal-id="myModal">Edit</a>
      
      
</li><?php
	
	
}
?>
</ul>
</div>



<div id="myModal" class="reveal-modal<?php if($this->agent->is_mobile()){ ?> small<?php }else{ ?> large<?php } ?>">
		<div id="details"></div>
			<a class="close-reveal-modal">&#215;</a>
		</div>




<script type="text/javascript">


<?php if(!$this->agent->is_mobile()){ ?>
	
	
	
$(function() {
		$( "#sortable-uploads" ).sortable({
		stop: function( event, ui ) {  save_files_order(); }
		
		});
	
	});
	
	function save_files_order(){
		var order = $( "#sortable-uploads").sortable( "serialize");
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>ajax/reorder/files",
			data: { orderdata: order }

		  
		}).done(function() { 
		
		
		
	
		});
		
	}
<?php } ?>
</script>




<script type="text/javascript">
$().ready(function(){



$('.edit-list').click(function() {

if ($(this).hasClass('active')) {
	
	// enable links
	$('.ui-sortable a').unbind('click');
	
	
	// restore hover
	$('.ui-sortable a').hover( 
  function() {
    $(this).css('background-color','#EEE');
     
  },
  function() {
		   $(this).css('background-color','transparent');
		   
	  }
  );
	
	
	
	 $(this).html('Edit');
	 
	 $('.edit-buttons').hide();
	 

	  $('.img').show();
	    $('.handle').hide();
	
	  if($(window).width()>500){
	  $('.pagename').show();
	  }
	  
	
	  $('.item-icon').show();
	  
	
     
	 $('.tabs .badge').removeClass('current'); 
	 $(this).css('background-color', '#999');
	 $(this).removeClass('active');	
	 
   }
   else { /*---------------------- else --------------------*/
	   
	   // disable links
	   $('.ui-sortable a').bind('click', function(e){
        e.preventDefault();
	})
	 
	 
	// disable hover
	$('.ui-sortable a').hover( 
  function() {
    $(this).css('background-color','transparent');
     
  },
  function() {
		   $(this).css('background-color','transparent');
		   
	  }
  );
	
	 
	
	   
	   $(this).html('Done');
	    
	$('.edit-buttons').show();
	  $('.item-icon').hide();
	
	 
	  
	    $('.pagename').hide();
	  
	
	
	 $('.tabs .badge').removeClass('current'); $(this).addClass('current'); $('.tabs .badge').css('background-color', '#999');	
	  
	  $('.active').removeClass('active');
	  $(this).addClass('active');
    
   }
});



});
	
</script>

	<?php


	
	
}



	
	

}



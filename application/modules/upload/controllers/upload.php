<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Upload extends MX_Controller {

	
	function __construct()
    {
        parent::__construct();
		
		
    }
	
	function uploadcare(){
		
	$data = array('filename'=>"https://ucarecdn.com/".$_POST['filename']."/", 'post_id'=>$_POST['post_id'], 'blog'=>$this->session->userdata('blog'));
	$this->db->insert('files', $data);
	}
	
	function jq_upload(){
		
		
		
		define("UPLOAD_DIR", $this->session->userdata('blog'));
		
		error_reporting(E_ALL | E_STRICT);
		
		$this->load->library('UploadHandler');
		$this->uploadhandler;
		
		
	}
	
	function save_jq_upload(){
		
		$title = str_replace('-', ' ', $_POST['filename']);
		$title = str_replace('_', ' ', $title);
		$title = str_replace('.jpg', '', $title);
		$title = str_replace('.png', '', $title);
		$title = str_replace('.gif', '', $title);
		
		
		$data=array('blog'=>$this->session->userdata('blog'), 'post_id'=>$_POST['post_id'], 'filename'=>$_POST['filename'], 'title'=>$title, 'category'=>'gallery');
		
		$this->db->insert('files', $data);
		
	}
	
	function save_title2($id){
	
		$data=array('title'=>$_POST['value'], 'description'=>$_POST['description']);
		$this->db->where('id', $id);
		$this->db->update('files', $data);
	
	}
	
	function show_images($post_id){
		
	
   $this->db->where('blog', $this->session->userdata('blog'));
   $this->db->where('post_id', $post_id);
   $q=$this->db->get('files');
   
   foreach($q->result() as $item){
	   ?>
      <div class="box well" style="padding: 3px; margin-bottom: 5px; margin-top: 0;" id="img-<?=$item->id?>"> 
      
      <!--
      <img src="<?=base_url();?>uploads/thumb.php?src=default/<?=$item->filename;?>&w=60&h=60&zc=1" class="img-polaroid" /> 
      -->
         <img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/small/<?=$item->filename;?>&w=75&h=75&zc=1" width="60" class="img-polaroid" /> 
         
      
     
      <input type="text" value="<?=$item->title;?>" style="margin-left: 10px; margin-top: 5px;" onblur='$.ajax({type:"POST",url:"<?=base_url();?>upload/save_title2/<?=$item->id;?>",data:{value: $(this).val()}, context: document.body}).done(function(){  });' placeholder="Image title" />
      
      <div style="float: right; margin-top: 24px;"><a href="javascript: void(0);" onclick='$.ajax({url: "<?=base_url();?>upload/delete/<?=$item->id;?>",context: document.body}).done(function(){$("#img-<?=$item->id?>").fadeOut("slow");});'><span class="icon" style="border: 0;"><i class="icon-remove"></i></span></a></div>
      
      </div>
       
	   <?php
	   
   		}
        
	   if($q->num_rows()>0){
		   ?>
           <br>
           <?php
		   
	   }
   
	}
	
	
	function do_upload(){
		
		
		
	//if(debug()){ echo $this->input->post("PHPSESSID"); }
	
		
		
	/* --------------- getting the swfupload session right ------------------------- */
       $params['session_id'] = $this->input->post("PHPSESSID");
       //load the session library the new way, by passing it the session id
       $this->load->library('session', $params);
	   
	
       
       //now if the session was posted, and it loaded correctly, you will have
       //access to your session !
	   
	   if(debug()){
       // if ($this->session->userdata('logged_in') != true) echo "please log in"; //cancel if the user is not logged in
	   echo $this->session->userdata('blog');
	   }
	   
	  

        // $user_id = $this->session->userdata('user_id');
		
		// somehow we need to set it again
		$this->session->set_userdata('files_id', $this->input->post('files_id'));

		
	/* --------------- end getting the swfupload session right ------------------------- */	
			
			if (!empty($_FILES)) {
				
		
				
				
			$tempFile = $_FILES['Filedata']['tmp_name'];
		
			$new_filename=date('dmyhis').strtolower(rand(10,1000).'_'.str_replace("_", "-", str_replace(' ', '-', $_FILES['Filedata']['name']))); // replace underscores with normal stripes, see rte_alt
			
			
			$targetPath = APPPATH.'../uploads/'.$this->input->post('blog').'/';
			$targetFile =  str_replace('//','/',$targetPath) . $new_filename;
			
			
					


			
			 //$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
			 //$fileTypes  = str_replace(';','|',$fileTypes);
			 
			 $fileTypes = 'jpg|png|gif|doc|xls|pdf|mp3|zip';
			 
			 $typesArray = explode('|',$fileTypes);
			 $fileParts  = pathinfo($_FILES['Filedata']['name']);
			 
			 $extension = strtolower($fileParts['extension']); // fix for uppercase .JPG
			
			 if (in_array($extension,$typesArray)) {
				// Uncomment the following line if you want to make the directory if it doesn't exist
				// mkdir(str_replace('//','/',$targetPath), 0755, true);
				
				move_uploaded_file($tempFile,$targetFile);
				
				
				
			
			
				//rename($targetFile, $targetPath.$new_filename);
				
				
				
			
				
				/* thumbnailing */
				   
				
				$picloc = $new_filename;
				
				$imagemanip['image_library'] = 'gd2';
				$imagemanip['source_image'] = './uploads/'.$this->input->post('blog').'/'.$picloc;
				$imagemanip['maintain_ratio'] = TRUE;
				$imagemanip['quality'] = '90%';
				$imagemanip['width'] = 700;
				$imagemanip['height'] = 1000;
				
				//$this->image_lib->resize();
				 $this->load->library('image_lib', $imagemanip);
				
				if ( ! $this->image_lib->resize())
				{
					echo $this->image_lib->display_errors();
					
					exit;
				}
				
				
				
				$title=str_replace('.mp3', '', $_FILES['Filedata']['name']);
				$title=str_replace('.jpg', '', $title);
				$title=str_replace('.jpeg', '', $title);
				$title=str_replace('.png', '', $title);
				$title=str_replace('.gif', '', $title);
				if($this->input->post("category")=='mp3'){ // remove numbering in front of mp3's
				$title = preg_replace('/[0-9]*/', '', $title);
				}
				
				
				
				$data=array('blog'=>$this->input->post('blog'), 'post_id'=>$this->input->post('files_id'), 'filename'=>$new_filename, 'title'=>$title, 'type'=>$this->input->post("category"));
				$this->db->insert('files', $data);
			
				
				
	/*	
	if(debug()){
		
					$this->load->library('email');
					
					$this->email->from('support@blogbird.nl', 'BlogBird');
					$this->email->to('gerben@zomp.nl');
					$this->email->subject('Message from your debugger.');
					$this->email->message("extensie: ".$fileParts['extension']);
					$this->email->send();
					
	}
	*/

				
				
				if($extension=='jpg' || $extension=='png' || $extension=='gif'){
				echo "img".$new_filename;
				
				}
				else
				{
				echo "doc".$new_filename;	
				}
				
				
			 } else {
				echo 0;
			 }
			
			
			
			
		}
		
	}
	
	
	function delete($id){
		
		auth(1);
		
		$this->db->where('id', $id);
		$q=$this->db->get('files');
		
		$file = $q->row();
		
		@unlink(APPPATH.'../uploads/'.$this->session->userdata('blog').'/'.$file->filename);
		@unlink(APPPATH.'../uploads/'.$this->session->userdata('blog').'/small/'.$file->filename);
		@unlink(APPPATH.'../uploads/'.$this->session->userdata('blog').'/medium/'.$file->filename);
		@unlink(APPPATH.'../uploads/'.$this->session->userdata('blog').'/large/'.$file->filename);
		@unlink(APPPATH.'../uploads/'.$this->session->userdata('blog').'/square/'.$file->filename);
		@unlink(APPPATH.'../uploads/'.$this->session->userdata('blog').'/huge/'.$file->filename);
		
		$this->db->where('id', $id);
		$this->db->delete('files');
		
		
		
	}
	
	

function uploader($category, $files_id=0){	


?>


<div class="note">Use shift to select multiple images at once</div>

<table width="100%" border="0">
  <tr>
    <td width="350">
    <input name="files_id" type="hidden" value="<?=$files_id;?>" />
    <?php // if(debug()){ echo $this->session->userdata('files_id'); } ?>
    

    
    <div>




<input type="file" name="fileInput" id="fileInput_<?=$category;?>" /> 

<?php
$this->load->library('user_agent');
if($this->agent->is_mobile()){
?>
<div class="error">Error: Flash has not been installed.</div>

<?php } ?>


<script type="text/javascript">

$(document).ready(function() {
$('#fileInput_<?=$category;?>').uploadify({
'uploader'  : '<?=base_url();?>application/sources/js/uploadify/scripts/uploadify.swf',
'script'    : '<?=base_url();?>application/sources/js/uploadify/scripts/uploadify.php',
'cancelImg' : '<?=base_url();?>application/sources/js/uploadify/cancel.png',
'auto'      : true,
'multi'		: true,
'debug' 	: true,

<?php if($category=='gallery'){ ?>
'fileExt'	: '*.jpg;*.gif;*.png;',
'fileDesc'  : 'Alleen .jpg, .gif en .png',
<?php }elseif($category=='mp3'){ ?>
'fileExt'	: '*.mp3;',
'fileDesc'  : 'Alleen .mp3',
<?php } ?>
'onComplete': function(event, queueID, fileObj, response, data){ 
$('fileInput'+queueID).append('style');


// alert(response);


},

'onAllComplete': function(event, data){

$('#response').load('<?=base_url();?>upload/response/<?=$category;?>/<?=$files_id;?>').fadeIn();
},

'scriptData': {
		'category'	   : '<?=$category;?>',
		'blog' : '<?=$this->session->userdata('blog');?>',
        'files_id' : '<?=$files_id;?>',
		'replace' : '0',
		'PHPSESSID': '<?=$this->session->userdata('session_id');?>'
       
      },
'script'	: '<?=base_url();?>upload/do_upload',	  
'folder'    : '<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/'
});
});
</script>
</div>

<div id="fileInputUploader"></div>
    

    </td>
    <td valign="top"><div id="<?=$category;?>editor"></div></td>
  </tr>
</table>



<div id="response"><?=modules::run('upload/response', $category, $files_id);?></div>



<?php


}




function response($category, $files_id=0){
	
	if($files_id==0){
		$files_id = $this->session->userdata('files_id');
	}
	
	
	
	?>
    

    



<style type="text/css">
	#sortable_<?=$category;?> { list-style-type: none; margin: 0; padding: 0; }
	
	#sortable_gallery li { margin: 5px 5px 5px 3px; padding: 1px; float: left; width: 67px; height: 87px; font-size: 4em; text-align: center; border: 1px solid #CCC; }
	
	</style>


<script type="text/javascript">
	$(function() {
		$("#sortable_<?=$category;?>").sortable({
		handle: '.handle',
		update : function () { 
		var order = $('#sortable_<?=$category;?>').sortable('serialize'); 
		//$("#info").load("<?=base_url();?>pages/reorder/"+order);										  
		  jQuery.ajax({
		  type: "post",
		  data: order, // assuming this == the form
		  url: "<?=base_url();?>upload/reorder/",
		  success: function(){
				$("#info").html("Volgorde Opgeslagen").fadeIn(); // wow!
				$("#info").fadeIn();
				$("#info").fadeOut('slow');
			  }
		
		 
		});
										  
			} 
		});
		$("#sortable_<?=$category;?>").disableSelection();
		
	});
</script>

<br />

<ul id="sortable_<?=$category;?>">

<?php

/*
<li id="item_<?=$file->id;?>"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="<?=base_url();?>uploads/thumb.php?src=<?=$file->filename;?>&w=67&h=67&zc=1" class="handle" /></td>
  </tr>
  <tr>
   <td style="padding-top: 2px; font-size: 12px;" align="left" width="25"><a href="#" onClick="$('#<?=$category;?>editor').load('<?=base_url();?>upload/in_place/<?=$file->id;?>');"><?php // if($file->title){ echo $file->title; }else{ echo "wijzig titel"; } ?><img src="<?=base_url();?>application/sources/img/icons/post.png" border="0"></a> <a href="javascript: void(0);" onClick="$('#response').load('<?=base_url();?>upload/delete/<?=$file->id;?>'); $('#item_<?=$file->id;?>').fadeOut('slow');" style="float: right;"><img src="<?=base_url();?>application/sources/img/icons/cross.png" border="0"></a> 
</td>
 

  </tr>
</table>
</li>
*/

if($category=='gallery'){
$limit=14;	
}
else
{
$limit=6;	
}

$this->db->where('post_id', $files_id);
$this->db->where('type', $category);
$this->db->order_by('order_id');
$q=$this->db->get('files');
$numrows=$q->num_rows();


	$this->db->where('post_id', $files_id);
	$this->db->where('type', $category);
	$this->db->order_by('order_id');
	$this->db->limit($limit);
	$q=$this->db->get('files');
	
	
	
	
	
	if($q->num_rows() > 0){
	foreach($q->result() as $file){
		
		if($category=='gallery'){
	?>

    <li id="item_<?=$file->id;?>"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="preview_image"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&w=67&h=67&zc=1" class="handle" /></div></td>
  </tr>
  <tr>
   <td style="padding-top: 2px; font-size: 12px;" align="left" width="25"><a href="#" onClick="showModal('Edit', '<?=base_url();?>upload/in_place/<?=$file->id;?>');"><?php // if($file->title){ echo $file->title; }else{ echo "wijzig titel"; } ?><img src="<?=base_url();?>application/sources/icons/pencil.png" border="0"></a> <a href="javascript: void(0);" onClick="$.ajax({ url: '<?=base_url();?>upload/delete/<?=$file->id;?>'}); $('#item_<?=$file->id;?>').fadeOut('slow');" style="float: right;"><img src="<?=base_url();?>application/sources/icons/cross.png" border="0"></a> 
</td>
 

  </tr>
</table>
</li>
<?php }else{ ?>
    
    <li id="item_<?=$file->id;?>">

<div style="padding: 3px; padding-bottom: 0px; border: 1px solid #CCC; margin-bottom: 5px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="25"><div id="preview_image"><img src="<?=base_url();?>application/sources/img/draggable2.png" class="handle" /></div></td>
    <td>
    	
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="300" height="25"
		codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" >
    <param name="movie" value="<?=base_url();?>application/sources/js/audioplayer/player.swf" />
    <param name="flashvars" value="soundFile=<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&titles=<?=$file->title;?>&autostart=no&animation=no" />
    <embed src="<?=base_url();?>application/sources/js/audioplayer/player.swf" width="300" height="25" flashvars="soundFile=<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&titles=<?=$file->title;?>&autostart=no&animation=no" 
    	type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>


</td>
    
    <td width="50"><a href="#" onClick="$('#<?=$category;?>editor').load('<?=base_url();?>upload/in_place/<?=$file->id;?>');"><?php // if($file->title){ echo $file->title; }else{ echo "wijzig titel"; } ?><img src="<?=base_url();?>application/sources/img/icons/post.png" border="0"></a> <a href="javascript: void(0);" onClick="$.ajax({ url: '<?=base_url();?>upload/delete/<?=$file->id;?>'}); $('#item_<?=$file->id;?>').fadeOut('slow');" style="float: right;"><img src="<?=base_url();?>application/sources/img/icons/cross.png" border="0"></a> </td>
  </tr>
</table>
</div>
</li>


			
        
        <?php
			}
		
		}
		
		
	}
	
	

?>





<?php

$this->db->where('post_id', $files_id);
	$this->db->where('type', $category);
	$this->db->order_by('order_id');
	$this->db->limit(50,$limit);
	$q=$this->db->get('files');
	
	
	
	foreach($q->result() as $file){

	
		if($category=='gallery'){
	?>
    
    <li id="item_<?=$file->id;?>" class="hide" style="display: none;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="preview_image"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&w=67&h=67&zc=1" class="handle" /></div></td>
  </tr>
  <tr>
   <td style="padding-top: 2px; font-size: 12px;" align="left" width="25"><a href="#" onClick="$('#<?=$category;?>editor').load('<?=base_url();?>upload/in_place/<?=$file->id;?>');"><?php // if($file->title){ echo $file->title; }else{ echo "wijzig titel"; } ?><img src="<?=base_url();?>application/sources/icons/pencil.png" border="0"></a> <a href="javascript: void(0);" onClick="$.ajax({ url: '<?=base_url();?>upload/delete/<?=$file->id;?>'}); $('#item_<?=$file->id;?>').fadeOut('slow');" style="float: right;"><img src="<?=base_url();?>application/sources/icons/cross.png" border="0"></a> 
</td>
 

  </tr>
</table>
</li>
<?php }else{ ?>
    
    <li id="item_<?=$file->id;?>" class="hide" style="display: none;">

<div style="padding: 2px; border: 1px solid #CCC; margin-bottom: 5px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="25"><div id="preview_image"><img src="<?=base_url();?>application/sources/img/draggable2.png" class="handle" /></div></td>
    <td>
    	
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="300" height="30"
		codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" >
    <param name="movie" value="<?=base_url();?>application/sources/js/audioplayer/player.swf" />
    <param name="flashvars" value="soundFile=<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&titles=<?=$file->title;?>&autostart=no&animation=no" />
    <embed src="<?=base_url();?>application/sources/js/audioplayer/player.swf" width="300" height="30" flashvars="soundFile=<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&titles=<?=$file->title;?>&autostart=no&animation=no" 
    	type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>


</td>
    
    <td width="50"><a href="#" onClick="$('#<?=$category;?>editor').load('<?=base_url();?>upload/in_place/<?=$file->id;?>');"><?php // if($file->title){ echo $file->title; }else{ echo "wijzig titel"; } ?><img src="<?=base_url();?>application/sources/img/icons/post.png" border="0"></a> <a href="javascript: void(0);" onClick="$('#response').load('<?=base_url();?>upload/delete/<?=$file->id;?>'); $('#item_<?=$file->id;?>').fadeOut('slow');" style="float: right;"><img src="<?=base_url();?>application/sources/img/icons/cross.png" border="0"></a> </td>
  </tr>
</table>
</div>
</li>


			

<?php } } ?>

	


</ul>


<div style="clear: both;"></div>

<?php

if($numrows>$limit){
	?>
<a href="javascript: void();" onclick="$('.hide').show(); $(this).hide();" class="fullscreen_mode">&raquo; <?=$this->lang->line('show_all');?> (<?=$numrows;?>)</a>
<?php
	}
	
	
    
    
	
}



function save_title(){
	
	auth(1);

	
	$data=array('title'=>$_POST['value'], 'url'=>$_POST['url'], 'description'=>$_POST['description'], 'mark'=>$_POST['mark']);
	
	$this->db->where('id', $_POST['id']);
	$this->db->update('files', $data);
	
	echo $_POST['value'];
	
}
	


	function reorder(){
	
	// Now we need to update the position field of these items    
	
		foreach($_POST['item'] as $i=>$id ){
		   // For our first record, $i is 0, and $id is 2.
		$data=array('order_id'=>$i);
		$this->db->where('id', $id);
		$this->db->update('files', $data);
		
		}
			
	
		
	}
	
	
	function in_place($id){
		
		$this->db->where('id', $id);
		$q=$this->db->get('files');
		$file=$q->row();
		?>
        
        <form id="dialog">
        Title<br />
        <input name="title" type="text" value="<?=$file->title;?>" size="45" />
        <br />
        
        
       
        </form>
        <br />
        <a href="javascript: void(0);" onclick="saveDialog();"><img src="<?=base_url();?>application/sources/img/save.png" border="0" /></a>
        
        <script type="text/javascript" charset="utf-8">
	
	  
	 function saveDialog(){
		var mydata = $("#dialog").serialize();
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>upload/in_place_save/<?=$id;?>",
			data: { formdata: mydata }

		  
		}).done(function() { 
		
$('#redactor_modal').fadeOut('slow');
		});
	} 
	
	</script>
        
        <?php
		
		
	}
	
	
	function in_place_save($id){
		if($_POST){
			
			
		$data = array();
		parse_str($_POST['formdata'], $data);
			
			
			$this->db->where('id', $id);
			$this->db->update('files', $data);
			
		}
		
		
	}
	
	
	
	
	// rich text editor upload
	function upload_image(){
		
		
		auth();
	
		$config['upload_path'] = APPPATH.'../uploads/'.$this->session->userdata('blog').'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['encrypt_name'] = TRUE;
		/*
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		*/

		$this->load->library('upload', $config);

		$field_name = 'file';

		if ( ! $this->upload->do_upload($field_name))
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			// resizing
			
			
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $data['upload_data']['full_path'];
			$config2['new_image'] = $data['upload_data']['full_path'];
			
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			
			$config2['width'] = 600;
			$config2['height'] = 400;
			
			
			$this->load->library('image_lib', $config2);
			
			$this->image_lib->resize();
			
			
			
			 // displaying file    
				$array = array(
					'filelink' => base_url().'uploads/'.$this->session->userdata('blog')."/".$data['upload_data']['file_name']
				);
				
				
				echo stripslashes(json_encode($array));  

			//$this->load->view('upload_success', $data);
		}
		
	}
	
}

?>
<?php auth();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$this->config->item('system');?> - Dashboard</title>


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />


<!-- Bootstrap -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet/less" type="text/css" href="<?=base_url();?>application/views/sparrow/js/glyph-retina/less/sprites.less">
<script src="https://raw.github.com/less/less.js/master/dist/less-1.4.1.min.js" type="text/javascript"></script>


<?php if($this->uri->segment(1)=='posts'){ ?>
<!-- Ajax Upload -->
<link href="<?=base_url();?>application/modules/ajax_upload/js/mini-upload-form/assets/css/style.css" rel="stylesheet" />
<script src="<?=base_url();?>application/modules/ajax_upload/js/mini-upload-form/assets/js/jquery.iframe-transport.js"></script>
<script src="<?=base_url();?>application/modules/ajax_upload/js/mini-upload-form/assets/js/jquery.fileupload.js"></script>

<!-- Reveal -->
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/reveal/reveal.css" />	
<script type="text/javascript" src="<?=base_url();?>application/sources/js/reveal/jquery.reveal.js"></script>

<?php } ?>

<!-- Redactor -->
<script src="<?=base_url();?>application/sources/js/redactor901/redactor/redactor.js"></script>
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/redactor901/redactor/redactor.css" />

<!-- Zomp TinyTabs -->
<script src="<?=base_url();?>application/sources/js/tinytabs/tinytabs.js"></script>





<!-- App Styles and JS -->
<script type="text/javascript">
var base_url = '<?=base_url();?>';
var breakpoint_hi = 1110;
var breakpoint_lo = 770;


 function load_redactor() {

     $('#body, #extended').redactor({
         buttons: ['bold', 'italic', '|',
             'unorderedlist', 'orderedlist', '|',
             'image', 'table', 'link', '|',
             'alignleft', 'aligncenter', 'alignright', '|',
             'horizontalrule', '|', 'html'],
         minHeight: 250,
         imageUpload: base_url+'upload/upload_image'


     });
	 
	 

 }


</script>


<link rel="stylesheet" href="<?=base_url();?>application/views/sparrow/style.css" type="text/css" media="screen" />


<link rel="stylesheet" href="<?=base_url();?>application/views/sparrow/mobile.css" type="text/css" media="screen" />

<link href="<?=base_url();?>application/plugins/icon-toolbar/css/style.css" rel="stylesheet">

</head>

<body>

<?php include(APPPATH."plugins/icon-toolbar/navbar.php"); ?>


<div id="message"></div>


<div id="wrapper">
 
<span style="float: left;"><a href="<?=base_url();?>" title="back to members area"><img src="http://www.blogbird.nl/tools/img/logo.png" id="logo" /></a></span>
  

    
    <div id="head">
    
    <div id="save"></div>





     
   	</div>
     
     
    <div id="content">
    
 
    
        <div id="toolbar"><div id="loading" style="display: none;"><img src="<?=base_url();?>application/sources/img/spinner.gif" /></div>   </div>
        
        <div id="maincontent">
        
        
      
        
        
        
        
        <div id="side">
            <div id="sidehead"> 
            </div>
            
            
           <div id="sidenav2"> 
           
           
           <ul id="nav">
           
           
<?php
function num($table){
	$CI =& get_instance();
	$CI->db->where('blog', $CI->session->userdata('blog'));
	$q=$CI->db->get($table);
	return $q->num_rows();
}
?>           

<li><a id="dashboard" style="height: 40px;" href="<?=base_url();?>dashboard"<?php if($this->uri->segment(1)=='dashboard'){ ?> class="current-item"<?php } ?>>

    <span class="icon"><i class="icon-home"></i></span>
    <span class="title"><strong>Dashboard</strong></span>
    <br />
    <span class="subtitle">Overview of your stats</span>

</a></li>



<li><a id="posts" style="height: 40px;" href="<?=base_url();?>manage/all/posts"<?php if($this->uri->segment(1)=='posts' || $this->uri->segment(3)=='posts'){ ?> class="current-item"<?php } ?>>

    <span class="icon"><i class="icon-pencil"></i></span>
    <span class="title"><strong>Posts</strong></span>
    <span class="badge badge-warning"><?=num('posts');?></span>
    <br />
    <span class="subtitle">Overview of your posts</span>

</a></li>

<li><a id="pages" style="height: 40px;" href="<?=base_url();?>manage/all/pages"<?php if($this->uri->segment(1)=='pages' || $this->uri->segment(3)=='pages'){ ?> class="current-item"<?php } ?>

    <span class="icon"><i class="icon-file"></i></span>
    <span class="title"><strong>Pages</strong></span>
    <span class="badge badge-warning"><?=num('pages');?></span>
    <br />
    <span class="subtitle">Create and reorder pages</span>

</a></li>


<li><a id="users" style="height: 40px;" href="<?=base_url();?>manage/all/users"<?php if($this->uri->segment(1)=='users' || $this->uri->segment(3)=='users'){ ?> class="current-item"<?php } ?>>

    <span class="icon"><i class="icon-user"></i></span>
    <span class="title"><strong>Users</strong></span>
    <span class="badge badge-warning"><?=num('users');?></span>
    <br />
    <span class="subtitle">Overview of users</span>

</a></li>




<li><a id="settings" style="height: 40px;" href="<?=base_url();?>manage/settings"<?php if($this->uri->segment(1)=='settings' || $this->uri->segment(2)=='settings'){ ?> class="current-item"<?php } ?>>

    <span class="icon"><i class="icon-wrench"></i></span>
    <span class="title"><strong>Settings</strong></span>
   
    <br />
    <span class="subtitle">Manage the system's settings</span>

</a></li>






</ul>
       
     
           
           </div> 
            
   
   
            
            
        </div>
        


        <div id="main">
           
            
            
        <?php echo $this->load->view($maincontent); ?>
            
         
            
        </div>
        
      
        
        
        </div>
        <div style="clear: both;"></div>
        
        <div id="notification"></div>
        
        
        
    </div>

<div id="info"><br />
</div>

<div class="small-hide">
<br /><br /><br />
</div>

<script type="text/javascript">



function save(controller, id){
		
	
		
	$.ajax({
    type: "POST",
    url:'<?=base_url();?>'+controller+'/edit/'+id,
    data: $('#myform').serialize(),

    success: function(data){
		
		
		
		
		
		
		if(data.substr(0,6)=='Error:'){
			
			showMessage(data, 1);
			
			
			/*
			$('#save .button').css('background-image', 'url(<?=base_url();?>application/views/sparrow/img/button-large.png)');
			$('#save .button').css('width', '175px');
		
			$('#save .button').html('<span id="save-inner"><i class="icon"><span class="icon-warning-sign" style="margin-right: 5px;"></span></i>'+data.replace('Error: ', '')+'</span>');
			
			setTimeout(resetSave,3000);
			*/
		
			
		}else{
			
			
			
			showMessage('Saved. <a href="'+base_url+'manage/all/'+controller+'">Back to overview</a>', 0);	
			
			
			

		}
		
		
		
       }
	});
	
	}
	
	
	function resetSave(){
		$('#save-inner').fadeOut('slow', function(){
			
			$('#save .button').html('Save');
			
			$('#save .button').fadeIn('slow');
			
			
			
			$('#save .button').css('background-image', 'url(<?=base_url();?>application/views/sparrow/img/button.png)');	
			$('#save .button').css('width', '126px');
			
		
		});
		
		
	}
	
	
	$(document).ready(function(){
	
	// only reload the sidebar on page refresh
	var hash = window.location.hash;
	var parts = hash.split('/');

	$('#sidenav').load('<?=base_url();?>ajax/side/'+parts[1], function(){
		
		if(parts[2]){
		
		var module = parts[1];
		var id = parts[2];
		
		$('.current-item').removeClass('current-item');
		
		if(id!=''){
		$('#'+module+'-'+id).addClass('current-item');
		}
		else
		{
		$('#'+module+'-add').addClass('current-item');	
		}
		
	}
		
		
	});
	
	
	
	
	
	
});

function showMessage(message, error){
	
if(error==1){
	$('#message').html('<i class="icon-warning-sign" style="margin-right: 5px; margin-top: -2px;"></i> '+message);
			
	$('#message').slideDown('slow', function() {
	setTimeout(hideMessage,2500);
	});		
}else
{
	$('#message').html('<i class="icon icon-ok" style="margin-right: 5px; margin-top: -2px;"></i> '+message);
			
	$('#message').slideDown('slow', function() {
	setTimeout(hideMessage,2500);
	});	
}
	

}

function hideMessage(){
	$('#message').slideUp('slow', function() {
	
});
}



</script>
		 


</body>
</html>
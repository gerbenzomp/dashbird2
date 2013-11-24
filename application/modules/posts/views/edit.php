
<?php
$thm = themePrefs();

?>



<script>
  $().ready(function(){
		  
	$('#tinytabs2').tinytabs({transition: 'fade'});	  
		
  });

</script>







<!--

<h5><?php if($this->uri->segment(3)){ echo "Edit"; }else{ echo "Add"; } ?> Post</h5>

-->


<?php
$this->db->where('post_id', $id);
$q=$this->db->get('files');
$totalfiles = $q->num_rows();
if($totalfiles>0){
	$numfiles = " <span class='status'>".$totalfiles."</span>";
}
else{
$numfiles = '';	
}

$num_addons = 0;
if($twitter_username !=''){
$num_addons = $num_addons + 1;
}
if($facebook_username !=''){
$num_addons = $num_addons + 1;
}
if($embed !=''){
$num_addons = $num_addons + 1;
}
if($email!=''){
	$num_addons = $num_addons + 1;
}

if($price!='0.00'){
	$num_addons = $num_addons + 1;
}

if($num_addons>0){
	$numaddons = " <span class='status'>".$num_addons."</span>";
}
else{
$numaddons = "";	
}
?>



  
    <div id="tinytabs2">
    <ul class="tabs">
    
		<li><a href="#tab1" class="tinytabs current badge">Title and body</a></li>
		<li><a href="#tab2" class="tinytabs badge" id="tab-photo">Gallery<?=$numfiles;?></a></li>
        
        <!--
		<li><a href="#tab3" class="tinytabs badge">Add-ons<?=$numaddons;?></a></li>
        -->
         <?php if($this->router->method == 'modal_edit' && $visible != 0){ ?>
         
           <li style="float: right;"><a href="#tab5" class="tinytabs badge" class="iphone-hide">Delete</a></li>
        <li style="float: right;"><a href="#tab4" class="tinytabs badge" class="iphone-hide" onclick="parent.fancyAdjust();">Reorder</a></li>
        
        
        <?php } ?>
        
     
        
	</ul>
    
   
    
      <div class="tabcontent">
      
      <form id="myform">
    
    	<div id="tab1" class="tinycontent">
        
 
    
              <div class="row-fluid">
              
              
    <div class="span6">
    
    <label>Title</label>
    <input type="text" name="title" value="<?=$title;?>" class="input-xlarge" id="title">
    </div>
    
    
    <?php if(isset($thm['cols']) && $anchor==''){
		
		$width='80%';
		
		 ?>
      <div class="span3">
      <?php }else{
		  
		  $width='50%';
		   ?>
      <div class="span6">
      <?php } ?>
      
      
      <label>Page</label>
    <select name="page" style="width: <?=$width;?>;" id="pageselect">
    <?php
	$this->db->where('blog', $this->session->userdata('blog'));
	$q=$this->db->get('pages');
	foreach($q->result() as $item){
		?>
        <option value="<?=$item->url;?>"<?php if($item->url==$page){ echo " selected"; } ?>><?=$item->title;?></option>
        <?php
		
	}
	?>
    </select>
    </div>
    
  
   
		  <?php
	if(isset($thm['cols']) && $anchor==''){ ?>
	  <div class="span3">
    
    
        <label>Column</label>
    <select name="col" style="width: 100%;">
    <?php
	
	foreach($thm['cols'] as $mycol){
		?>
        <option value="<?=$mycol;?>"<?php if($mycol==$col){ echo " selected"; } ?>><?=ucwords(str_replace('-', ' ', $mycol));?></option>
        <?php
		
	}
	?>
    </select>
      </div>
     <?php } ?>
  
      
    <div class="row-fluid">
      <?php 
  
  if(isset($thm['subtitle-field'])){
  

  ?>
  
    <div class="span6">
  <label>Subtitle</label>
  <input type="text" name="subtitle" value="<?=$subtitle;?>" class="input">
</div>
  <?php } ?>
    

    
  <?php 
  
  if(isset($thm['date-field'])){
  
  if($date=='0000-00-00'){
	$date = date('Y-m-d');
  }
  ?>
   <div class="span6">
  <label>Date</label>
  <input type="text" name="date" value="<?=$date;?>" class="input-small" id="datepicker">
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
	
$( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
});
  
  </script>
  
  <?php } ?>
  
  </div>
   
   
   <label>Body</label>
    <textarea name="body" id="body" style="width: 100%;" rows="8"><?=$body;?></textarea>
 
  
 </div>
   </div>
    
    
        
        <div id="tab3" class="tinycontent">
        
        <script>
		function showAddOn(id){
			$('#info').hide();
			
			$('.addon').hide();
			$('#'+id).fadeIn('slow');
			$('.addon-button').css('background-color', '#999');
			$('#'+id+"-button").css('background-color', '#0099CC');
		}
		
		</script>
        
<?php $prefs = themePrefs(); ?>
        
<div id="addon-buttons">


<table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="javascript:;" onclick="showAddOn('youtube');" id="youtube-button" class="addon-button<?php if($embed!=''){ ?> addon-active<?php } ?>"><i class="icon fa-icon-youtube fa-icon-2x"></i></a></td>
    <td align="center"><a href="javascript:;" onclick="showAddOn('twitter');" id="twitter-button" class="addon-button"><i class="icon fa-icon-twitter fa-icon-2x"></i></a>
</td>
    <td align="center">
<a href="javascript:;" onclick="showAddOn('facebook');" id="facebook-button" class="addon-button"><i class="icon fa-icon-facebook fa-icon-2x"></i></a>
</td>
    <td align="center"><?php if(isset($prefs['addons']) && in_array('contact', $prefs['addons'])){ ?>
    <a  href="javascript:;" onclick="showAddOn('contact');" id="contact-button" class="addon-button"><i class="icon fa-icon-phone fa-icon-2x"></i></a>
    <?php } ?>
    </td>
    <td align="center"><?php if(isset($prefs['addons']) && in_array('shop', $prefs['addons'])){ ?>
<a  href="javascript:;" onclick="showAddOn('shop');" id="shop-button" class="addon-button"><i class="icon fa-icon-shopping-cart fa-icon-2x"></i></a>

<?php } ?></td>
    <td align="center"><?php if(isset($prefs['addons']) && in_array('forms', $prefs['addons']) || debug()){ ?>
<a  href="javascript:;" onclick="showAddOn('form-builder');" id="form-builder-button" class="addon-button"><i class="icon fa-icon-wrench fa-icon-2x"></i></a>

<?php } ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><small<?php if($embed !=''){ echo " class='active'"; } ?>>YouTube</small></td>
    <td align="center"><small<?php if($twitter_username !=''){ echo " class='active'"; } ?>>Twitter</small></td>
    <td align="center"><small<?php if($facebook_username !=''){ echo " class='active'"; } ?>>Facebook</small></td>
    <td align="center"><?php if(isset($prefs['addons']) && in_array('contact', $prefs['addons'])){ ?><small<?php if($email !=''){ echo " class='active'"; } ?>>Contact Form</small><?php } ?></td>
    <td align="center"><?php if(isset($prefs['addons']) && in_array('shop', $prefs['addons'])){ ?><small<?php if($price !='0.00'){ echo " class='active'"; } ?>>Product Price</small><?php } ?></td>
    <td align="center"><?php if(isset($prefs['addons']) && in_array('form-builder', $prefs['addons']) || debug()){ ?><small<?php if($form !='0'){ echo " class='active'"; } ?>>Form Builder</small><?php } ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



</div>

<hr />

<div class="addon" id="youtube" style="display: none;">
<?php include(APPPATH."add-ons/youtube/addon.php"); ?>
</div>


<div class="addon" id="twitter" style="display: none;">
<?php include(APPPATH."add-ons/twitter/addon.php"); ?>
</div>

<div class="addon" id="facebook" style="display: none;">
<?php include(APPPATH."add-ons/facebook/addon.php"); ?>
</div>

<?php if(isset($prefs['addons']) && in_array('contact', $prefs['addons'])){ ?>
<div class="addon" id="contact" style="display: none;">
<?php include(APPPATH."add-ons/contact/addon.php"); ?>
</div>
<?php } ?>

<?php if(isset($prefs['addons']) && in_array('shop', $prefs['addons'])){ ?>
<div class="addon" id="shop" style="display: none;">
<?php include(APPPATH."add-ons/shop/addon.php"); ?>
</div>
<?php } ?>

<?php if(isset($prefs['addons']) && in_array('form-builder', $prefs['addons']) || debug()){ ?>
<div class="addon" id="form-builder" style="display: none;">
<?php include(APPPATH."add-ons/form-builder/addon.php"); ?>
</div>
<?php } ?>




<div id="info">
<?php help_arrow('Add-ons allow you to add YouTube movies, forms, or even a shopping-cart to your post'); ?>
</div>
 
    <input type="hidden" name="author" value="<?php if($author==''){ echo $this->session->userdata('username'); }else{ echo ucwords($author); }?>">
    
       
    <input type="hidden" name="visible" value="1" /> 
    
   
  
<!--
    
   <?php if($visible != 0){ ?> <hr /><span class="delete label label-important"><a href="javascript:void(0);" id="posts-<?=$id;?>">delete</a></span> Delete this post<?php } ?>
   
   -->
    

  
        
        </div>   
   
    </div>
   
   

    
    
    </fieldset>
    
    

       
    
</form>

<div id="tab2" class="tinycontent">

 <?php if($this->session->userdata('blog')=='lala'){ ?>


  <?php echo modules::run('cloudupload/images', $id);?>
      

      <?php }else{ ?>
 
  


     <?php echo modules::run("ajax_upload/uploader", $id); ?>
     
    
     
     
     <?php } ?>
   

  
  


<div id="images">


</div>
  
  
     

   </div>
   
   
   
   
   
   <div id="tab4" class="tinycontent" style="height: 1000px;">
   
 <div id="postlist">
   
   <div class="alert">Reorder all posts in this column by dragging them around</div>

   
   <?=modules::run('posts/postlist', $page, '10', $col);?>
   
   </div>
   
   </div>
   
   
   <div id="tab5" class="tinycontent">
   <br /><br /><br /><br /><br />
   <table width="150" border="0" align="center">
  <tr>
    <td align="center">  <i class="fa-icon-trash fa-icon-4x"></i>
    
    </td>
 
  </tr>
  <tr>
    <td align="center">  
    <span class="delete badge" style="float:none; margin-left: -10px;"><a href="javascript:void(0);" id="posts-<?=$id;?>">delete</a></span>
    </td>
 
  </tr>
</table>
 
   
   
   </div>
   
   
   
   
    </div> <!-- end TinyTabs -->


<script type="text/javascript">
load_redactor();

$().ready(function(){
	
	$('#save').html('<a class="button" onclick="save(\'posts\', \'<?=$id;?>\');">Save</a>');

});


function save_modal(){

	$.ajax({
    type: "POST",
    url:'<?=base_url();?><?=$this->router->fetch_class();?>/edit/<?=$id;?>',
    data: $('#myform').serialize(),

    success: function(data){
		
		
		
window.parent.document.location.reload(); 
	    }
});
	
	
}






</script>

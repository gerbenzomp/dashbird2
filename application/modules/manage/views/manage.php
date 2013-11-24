<?php
if($module=='dashboard'){
	
	echo modules::run('dashboard/edit', 'dashboard');
	
	
}
elseif($module=='settings'){
	
	echo modules::run('settings/edit', 'general');
}
elseif($module=='stats'){
	
	echo modules::run('dashboard/show_stats', 'general');
}
else{




if($module=='posts'){ ?>



<ul class="tabs">

<li><a class="tinytabs badge" href="<?=base_url();?>posts/edit"><i class="fa fa-plus" style="color: white; margin-right: 3px;  margin-left: 2px; padding-right: 0;"></i>&nbsp;Add post &nbsp;</a></li>





<!--
		<li><a href="#" class="tinytabs current badge" onclick="$('.del').hide(); $('.handle').hide(); $('.item-icon').show(); $('.badge').removeClass('current'); $(this).addClass('current');">All posts</a></li>
    -->
   
   <div style="float: right;">
     <!-- <li><a class="tinytabs current badge showpages"><span  id="choose-page">Show: all</span> &nbsp;<i class="fa-icon-caret-down" style="color: white;"></i></a></li> 
		<li><a class="tinytabs badge edit-list">Edit</a></li>
		-->
    
	</div>
</ul>




<!-- Page: 
 <div id="showpages" class="dropdown" style="display: none;">   

Show posts on page:
<?php
$this->db->where('blog', $this->session->userdata('blog'));
$this->db->order_by('order_id');
$q=$this->db->get('pages');

$i=0;
foreach($q->result() as $item){
	?>
   <a onclick="showPage('<?=$item->url;?>', '<?=$item->title;?>');" style="cursor: pointer;"><span style="width: 30px; padding-left: 10px;"><i class="fa-icon-file"></i></span> <?=$item->title;?></a>
    
    <?
	$i++;
}


?>
<br />
 </div>  
-->

<div id="postlist">




<?php  echo modules::run('posts/postlist', 'all', 10); ?>


 
   

</div>



<!--
<br />

<div id="reorder"><a class="btn" onclick="startReorder();">Reorder Posts</a></div>
-->

<br />


    





<script type="text/javascript">

$().ready(function(){
	
	$('.tabs').css('width', $('#main').width());
	


	

});



$(document).on('click', '.showpages', function(){
	

	$('#showpages').slideDown();
	$(this).removeClass('showpages');
	$(this).addClass('hidepages');
	
});

$(document).on('click', '.hidepages', function(){
	$('#showpages').slideUp();
	$(this).removeClass('hidepages');
	$(this).addClass('showpages');
	
});


function sure(id) {
    if (confirm("Are you sure?")) {
        $.ajax({url: "<?=base_url();?>ajax/delete/posts/"+id}).done(function(){ $("#page_"+id).fadeOut("slow"); });
        return true;
    } else {
     //  alert("Clicked Cancel");
        return false;
    }
}



	
function showPage(url, title){
	
	
	
	
	$('#postlist').load('<?=base_url();?>posts/postlist/'+url+'/10');
	
	$('#choose-page').html(title);
	
	$('#showpages').slideUp('fast');
	
	$('.hidepages').addClass('showpages');
	$('.hidepages').removeClass('hidepages');
	
	
}



	
</script>




<?php

 }



/* ---------------------- reorder pages -------------------- */

?>



<?php if($module=='pages'){ ?>


<ul class="tabs">



<li><a class="tinytabs badge" href="<?=base_url();?>pages/edit">&nbsp;<i class="fa fa-plus" style="color: white; margin-right: 3px; padding-right: 0;"></i>&nbsp;Add page &nbsp;</a></li>



 <div style="float: right;">
      <!--
		<li><a class="tinytabs badge edit-list">Edit</a></li>
        -->
	
	</div>

</ul>
<ul class="ui-sortable" id="sortable" style="list-style-type: none; margin: 0; padding: 0;">

<?php

$this->db->where('blog', $this->session->userdata('blog'));
$this->db->order_by('order_id');
$q2=$this->db->get($module);

foreach($q2->result() as $item){
	
	
	?>
    
    
   
    <li style="clear: both;<?php if($item->subpage==1){ ?> width: 90%; float: right;<?php } ?>" class="sortable-item" id="page_<?=$item->id;?>">
    

    <table border="0" width="100%">
  <tbody><tr>
    <td width="15" class="small-hide"><span class="handle"><img src="<?=base_url();?>application/views/sparrow/img/reorder.png" /></span></td>
    <td><a href="<?=base_url();?>pages/edit/<?=$item->id;?>"><?php if($item->title!=''){ echo character_limiter($item->title, 25); }else{ echo "Untitled"; } ?></a></td>
    
    
      <?php
  $thm = themePrefs();

  if(isset($thm['subpages'])){
$width = 65;
  }else{
	  
	$width = 25;  
  }
	  
	  ?>
    <td width="<?=$width;?>">
  
    
   
<?php   if(isset($thm['subpages'])){ ?>
    
 <img class="sub" id="sub_<?=$item->id;?>" rel="tooltip" title="Turn page into subpage" src="<?=base_url();?>application/views/sparrow/img/into-subpage.png"<?php if($item->subpage==1){ ?> style="display: none;"<?php } ?> />
 
  <img class="nosub" id="nosub_<?=$item->id;?>" rel="tooltip" title="Turn subpage into mainpage" src="<?=base_url();?>application/views/sparrow/img/no-subpage.png"<?php if($item->subpage==0){ ?> style="display: none;"<?php } ?> />
  
  &nbsp;
  
  <?php } ?>
    
    <span class="del" id="del_<?=$item->id;?>"><i class="fa fa-times"></i></span>
    
    
   </td>
  </tr>
</tbody></table>

</li>
    

    <?php
	
	
}
?>
</ul>
<br />

  
<script type="text/javascript">

$().ready(function(){
	
	   $("[rel=tooltip]").tooltip({ placement: 'top'});
	
	
	$('.tabs').css('width', $('#main').width());
	
$('.del').click(function(e){
	e.preventDefault();
	var id = $(this).attr('id');
	id = id.replace('del_', '');
	sure(id);
});


	$(document).on('click', '.sub', function(e){
		
		var thisId = $(this).attr('id');
		var id = $(this).attr('id').replace('sub', 'page');
		var ajaxid = $(this).attr('id').replace('sub_', '');
		
		$('#'+id).css('width', '90%');
		$('#'+id).css('float', 'right');
	
			
		$('#'+thisId).hide();
		$('#no'+thisId).show();
	
		$.ajax({url: "<?=base_url();?>ajax/toggle_subpage/"+ajaxid+"/1"}).done(function(){  });
		
	});
	
	$(document).on('click', '.nosub', function(e){
		
		var thisId = $(this).attr('id');
		var id = $(this).attr('id').replace('nosub', 'page');
		var ajaxid = $(this).attr('id').replace('nosub_', '');
		
		$('#'+id).css('width', '100%');
		
		console.log(id);
		
		
		$('#'+thisId).hide();
		
		var thatId = thisId.replace('nosub', 'sub');
		$('#'+thatId).show();
		
		$.ajax({url: "<?=base_url();?>ajax/toggle_subpage/"+ajaxid+"/0"}).done(function(){  });
		
	});


});


function sure(id) {
    if (confirm("Are you sure?")) {
        $.ajax({url: "<?=base_url();?>ajax/delete/pages/"+id}).done(function(){ $("#page_"+id).fadeOut("slow"); });
        return true;
    } else {
      //  alert("Clicked Cancel");
        return false;
    }
}


$().ready(function(){
	
	
	
		$( "#sortable" ).sortable({
		stop: function( event, ui ) {  save_order('<?=$item->url;?>'); },
		 handle: '.handle'
		});
		$( "#sortable" ).disableSelection();
		
		


});


	
	function save_order(){
		var order = $( "#sortable").sortable( "serialize");
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>ajax/reorder/<?=$module;?>",
			data: { orderdata: order }

		  
		}).done(function() { 
		
		$('#save .button').html('<span id="save-inner"><i class="icon"><span class="icon-ok" style="margin-right: 5px;"></span></i> Saved</span>');
			
			
			setTimeout(resetSave,2000);
			
		
	
		});
	}
	
	
	

</script>

<?php

 }


/* ---------------------- reorder users -------------------- */

?>



<?php if($module=='users'){ ?>


<?php


if($this->session->userdata('blog_level')==1){
	?>
	 <h5>This feature is not available in your current plan.</h5> 
	<?php
	
}
else{
	
?>

<ul class="tabs">



<li><a class="tinytabs badge" href="<?=base_url();?>users/edit">&nbsp;<i class="fa fa-plus" style="color: white; margin-right: 3px; padding-right: 0;"></i>&nbsp;Add user &nbsp;</a></li>



 <div style="float: right;">
      
		<!--
		
		<li><a class="tinytabs badge edit-list">Edit</a></li>
        
        -->
    
	</div>

</ul>


<ul class="ui-sortable" id="sortable" style="list-style-type: none; margin: 0; padding: 0;">

<?php

$this->db->where('blog', $this->session->userdata('blog'));

$q2=$this->db->get($module);

foreach($q2->result() as $item){
	
	
	?>
    
    
    <li style="" class="sortable-item" id="page_<?=$item->id;?>"><table border="0" width="100%">
  <tbody><tr>
    <td width="25"><i class="icon-user" style="margin-left: 15px; margin-top: 0px; margin-right: 5px;"></i></td>
    <td><a href="<?=base_url();?>users/edit/<?=$item->id;?>"><?php if($item->username!=''){ echo character_limiter(ucwords($item->username), 25); }else{ echo "Untitled"; } ?></a></td>
    <td align="right" width="25"><?php if($q2->num_rows()>1){ ?><div class="del" id="del_<?=$item->id;?>"><i class="fa fa-times"></i></div><?php } ?></td>
  </tr>
</tbody></table></a>
</li>
    
    
    <?php
	
	
}
?>
</ul>


<script>
$().ready(function(){
	
	
	$('.tabs').css('width', $('#main').width());
	
$('.del').click(function(e){
	e.preventDefault();
	var id = $(this).attr('id');
	id = id.replace('del_', '');
	sure(id);
});

});


function sure(id) {
    if (confirm("Are you sure?")) {
        $.ajax({url: "<?=base_url();?>ajax/delete/users/"+id}).done(function(){ $("#page_"+id).fadeOut("slow"); });
        return true;
    } else {
       // alert("Clicked Cancel");
        return false;
    }
}


</script>

<?php

 }
}


/* ---------------------- reorder orders -------------------- */

?>



<?php if($module=='orders'){ ?>
  
    <div id="tinytabs2">

<ul class="tabs">



<li><a class="tinytabs badge current" href="#tab1">Bestellingen</a></li>

<li><a class="tinytabs badge" href="#tab2">Instellingen</a></li>
</ul>


    
      <div class="tabcontent">
      

    
    	<div id="tab1" class="tinycontent">

<ul class="ui-sortable" id="sortable" style="list-style-type: none; margin: 0; padding: 0;">

<?php

$this->db->where('blog', $this->session->userdata('blog'));
$this->db->order_by('id', 'desc');
$q2=$this->db->get($module);

foreach($q2->result() as $item){
	
	
	?>
    
    
    <li style="" class="sortable-item" id="page_<?=$item->id;?>"><table border="0" width="100%">
  <tbody><tr>
    <td width="25"><i class="icon-shopping-cart" style="margin-left: 15px; margin-top: 0px; margin-right: 5px;"></i></td>
    <td><a href="#!/orders/<?=$item->id;?>">Bestelling Nr. <?=$item->id;?> - <?php if($item->name!=''){ echo character_limiter(ucwords($item->name), 25); }else{ echo "Unknown"; } ?></a></td>
    <td align="right" width="75">
	<?php
	if($item->status=='Success'){
	?>	
	<i class="fa-icon-ok" title="success"></i>
	<?php	
	}
	elseif($item->status=='Cancelled'){
	?>	
	<i class="fa-icon-minus-sign" title="cancelled"></i>
	<?php	
	}
	
    
	
	?>
	</td>
  </tr>
</tbody></table></a>
</li>



    
    
    <?php
	
	
}
?>
</ul>

</div>

<div id="tab2" class="tinycontent">

<?=modules::run('orders/settings');?>

</div>

</div>
</div>

<script>
  $().ready(function(){
		  
	$('#tinytabs2').tinytabs({transition: 'fade'});	  
		
  });

</script>



<?php

 }


/* ---------------------- reorder dates -------------------- */

?>



<?php if($module=='dates'){ ?>
  
  
<ul class="tabs">

<li><a class="tinytabs badge" href="#!/add/dates">&nbsp;<i class="fa fa-plus" style="color: white; margin-right: 3px; padding-right: 0;"></i>&nbsp;Add date &nbsp;</a></li>

</ul>



<ul class="ui-sortable" id="sortable" style="list-style-type: none; margin: 0; padding: 0;">

<?php

$this->db->where('blog', $this->session->userdata('blog'));
$this->db->order_by('date', 'desc');
$q2=$this->db->get($module);

foreach($q2->result() as $item){
	
	
	?>
    
    
    <li style="" class="sortable-item" id="page_<?=$item->id;?>"><table border="0" width="100%">
  <tbody><tr>
    <td width="25"><i class="icon-calendar" style="margin-left: 15px; margin-top: 0px; margin-right: 5px;"></i></td>
    <td><a href="#!/dates/<?=$item->id;?>">
	<?php
	$date = $item->date;
	setlocale(LC_ALL,'nl_NL');
echo strftime("%d %B %Y", strtotime($date));

	?> - <?=strip_tags($item->event);?></a></td>
    <td align="right" width="75">
	<div class="del" id="del_<?=$item->id;?>"><i class="fa fa-times"></i></div>
	</td>
  </tr>
</tbody></table></a>
</li>



    
    
    <?php
	
	
}
?>
</ul>

<script type="text/javascript">

$().ready(function(){
	
	
	
$('.del').click(function(e){
	e.preventDefault();
	var id = $(this).attr('id');
	id = id.replace('del_', '');
	sure(id);
});

});

function sure(id) {
    if (confirm("Are you sure?")) {
        $.ajax({url: "<?=base_url();?>ajax/delete/dates/"+id}).done(function(){ $("#page_"+id).fadeOut("slow"); });
        return true;
    } else {
       // alert("Clicked Cancel");
        return false;
    }
}



</script>


<?php

 }

?>


<?php



/* ---------------------- reorder images -------------------- */

?>



<?php if($module=='files'){ ?>



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
		
		
		/*
		$('#save .button').html('<span id="save-inner"><i class="icon"><span class="icon-ok" style="margin-right: 5px;"></span></i> Saved</span>');
			
			
			setTimeout(resetSave,2000);
			*/
		
	
		});
		
	}
<?php } ?>
</script>



<?php

 }

?>


<?php if($module!='files' && $this->agent->mobile()){ ?>

<script src="<?=base_url();?>application/sources/js/touch-punch/touch-punch.js"></script>


<?php } ?>

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
	 
	 <?php if($module!='posts'){ ?>
	  $('.img').show();
	    $('.handle').hide();
		<?php } ?>
	  
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
	  
	  <?php if($module!='posts'){ ?>
	    $('.img').hide();
	  $('.handle').show();
	  <?php } ?>
	
	 $('.tabs .badge').removeClass('current'); $(this).addClass('current'); $('.tabs .badge').css('background-color', '#999');	
	  
	  $('.active').removeClass('active');
	  $(this).addClass('active');
    
   }
});



});
	


	<?php if($module!='files'){ ?>
	
	$().ready(function(){
		$('#add').attr('href', '#!/add/<?=$module;?>');
		
		$('#add').show();
		});
	
	
	
	<?php } ?>
			

</script>


<?php } ?>


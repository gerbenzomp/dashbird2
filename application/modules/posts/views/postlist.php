<ul class="ui-sortable" id="sortable-posts" style="list-style-type: none; margin: 0; padding: 0;">

<?php

$this->db->where('blog', $this->session->userdata('blog'));

if($page!='all'){
$this->db->where('page', $page);
$this->db->order_by('order_id asc, created desc');
}
else
{
$this->db->order_by('created desc');	
}
if($col!=''){
$this->db->where('col', $col);
}
$this->db->where('visible', 1);	
$this->db->limit($max);
$q2=$this->db->get('posts');



	




foreach($q2->result() as $item){
	
	$img = $this->blog->get_images($item->id, 1);
	
	?>
    
    
    <li style="" class="sortable-item" id="page_<?=$item->id;?>"><table border="0" width="100%">
  <tbody><tr>
  
      <?php if($page!='all'){ ?> <td width="15"><span class="handle" style="display: none;"><img src="<?=base_url();?>application/views/sparrow3/img/reorder.png" /></span></td><?php } ?>
 
      <td width="55">
      
      <a href="#!/posts/<?=$item->id;?>" style=" <?php if($page!='all'){ ?>padding-left: 5px;<?php }else{ ?>padding-left: 15px;<?php } ?>">   

      
 
       <?php if($img){ 
	   
	   ?>
 <?php if($img->placeholder!=''){ ?>
<div class="placeholder" style="background-image: url(<?=base_url();?>uploads/thumb.php?src=<?=$img->placeholder;?>&w=110&h=110&zc=1); background-size:55px 55px;"></div>

<?php }else{ ?>
	  
	<div class="placeholder" style="background-image: url(<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/square/<?=$img->filename;?>); background-size:55px 55px;"></div>
 <?php 
	}
 
 }else{ ?>
  <div class="placeholder"></div>
  <?php
  }
  ?>  


  </a>
  </td>
      
   
    <td>
	
	  <a href="<?=base_url();?>posts/edit/<?=$item->id;?>" style="padding-left: 0;">  
	<?php if($item->title!=''){ echo character_limiter($item->title, 25); }else{ echo "Untitled"; } ?>
  
    
    <div class="post-description">
<?php if($item->body!=''){ echo character_limiter(strip_tags($item->body), 85); }else{ echo "No description available."; } ?></div>
      </a>
    </td>
    <td width="30">
 

    
 
   
    
    <span class="del" id="del_<?=$item->id;?>"><i class="fa fa-times"></i></span>
    
    
  </td>
  </tr>
</tbody></table>

</li>
    
    
    <?php
	
	
}

?>

<?php if($q2->num_rows()==10){ ?>

   <li style="text-align: center;"><a onclick="$('#postlist').load('<?=base_url();?>posts/postlist/<?=$page;?>/50/<?=$col;?>');">Load more</a></li>
   <?php } ?>

</ul>



<script type="text/javascript">

$().ready(function(){
	
	
	
<?php

if($page!='all'){
	
	?>
		$( "#sortable-posts" ).sortable({
			 opacity: 0.6,
        cursor: 'move',
        tolerance: 'pointer',
        forcePlaceholderSize: true,
       
		stop: function( event, ui ) {  save_order(); },
		 
		});
		$( "#sortable-posts" ).disableSelection();
		
	<?php } ?>
	
		
		$('.del').click(function(e){
			
			
			e.preventDefault();
			var id = $(this).attr('id');
			id = id.replace('del_', '');
			sure(id);
		});


	
		

});


function save_order(){
		var order = $( "#sortable-posts").sortable( "serialize");
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>ajax/reorder/posts",
			data: { orderdata: order }

		  
		}).done(function() { 
		
		/*
		$('#save .button').html('<span id="save-inner"><i class="icon"><span class="icon-ok" style="margin-right: 5px;"></span></i> Saved</span>');
			
			
			setTimeout(resetSave,2000);
			
		*/
	
		});
		
	}
		


</script>





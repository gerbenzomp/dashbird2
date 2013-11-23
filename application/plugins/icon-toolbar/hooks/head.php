<style type="text/css">
.error{
padding: 10px;
border: 1px solid #C00;	
margin-bottom: 10px;
border-radius: 8px;
}

.success{
padding: 10px;
border: 1px solid #393;
margin-bottom: 10px;
border-radius: 8px;
}
</style>



<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

<script src="<?=base_url();?>application/sources/js/fancybox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>application/sources/js/fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />

<script type="text/javascript">

	
$(document).ready(function(){
	
		$(".shop").click(function(e) {
			
			e.preventDefault();
	
		var id = $(this).attr('id');
		
		var className = $(this).attr('class');
		
		var field = className.replace('edit ', '');
		
		field =  field.replace(' hover', '');
		
		
		// console.log(field);
		
		$.fancybox.open({
					href :  $(this).attr('href'),
					type : 'iframe',
					width: 750,
					height: 500,
					minHeight: 300,
					beforeShow: function(current, previous) {
     // $('.fancybox-outer').prepend('<div style="height: 36px; padding-top: 4px; margin-left: 850px;"><a class="btn btn-primary btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div>');
	 
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	
	 
    				},
					padding : 0
				});
				
			
		});
	
});
</script>


<?php if(logged_in()){
	
$CI =& get_instance();
	
?>

<link href="<?=base_url();?>application/plugins/icon-toolbar/css/style.css" rel="stylesheet">

<!-- tooltipster -->
<link rel="stylesheet" type="text/css" href="<?=base_url();?>application/plugins/icon-toolbar/js/tooltipster/css/tooltipster.css" />
<script type="text/javascript" src="<?=base_url();?>application/plugins/icon-toolbar/js/tooltipster/js/jquery.tooltipster.min.js"></script>

<script>
        $(document).ready(function() {
            $('.tooltips').tooltipster({
				theme: '.tooltipster-light',
			interactive: true	
			});
        });
    </script>
    
    
<script type="text/javascript">
 $(document).ready(function()
 {
    ShowActionOnOver();
    $(".action",this).hide(); // hide all
	
	
	ShowEditOnOver();
    $(".edit-buttons",this).hide(); // hide all
	
	
	$( '.edit').each(function(){
		var myid = $(this).attr("id");
		var margin = $("#"+myid).width()-115;
		
		
		$("#"+myid+" .edit-buttons").css("margin-left", margin+"px");
	
	
	}); 
	
	$( '.col').each(function(){
		
		var margin = $(this).width()-40;
	
		
		$(this).children('.action').css("margin-left", margin+"px");
	
	
	}); 
	
 });

 function ShowActionOnOver()
 {
   $(".col").hover(
       function()
       {
          $(".action",this).show();
       },
       function()
       {
           $(".action",this).hide();
        }
    );
 }
 
 function ShowEditOnOver()
 {
   $(".edit").hover(
       function()
       {
          $(".edit-buttons",this).show();
       },
       function()
       {
           $(".edit-buttons",this).hide();
        }
    );
 }
 


 </script>


    
    
<style type="text/css">

.edit-buttons{
position: absolute;
width: 0;
height: 0;	
}

.action_container{

}


.tooltipster-light {
border-radius: 5px;
border: 1px solid #cccccc;
background: #ededed;
color: #666666;
margin-top: -14px;
}
.tooltipster-light .tooltipster-content {
font-family: Arial, sans-serif;
font-size: 14px;
line-height: 16px;
padding: 8px 10px;
}

</style>    
    

<?php
$thm = themePrefs();
if(!isset($thm['bootstrap'])){
	?>
   <style>
   /* only if bootstrap is not included */
.nav-button span{
position: relative;
top: -4px;
}

.nav-button span.lower{
	top: -2px;
}



   </style> 
    
    <?php
	
}
?>

<script type="text/javascript">

$(document).ready(function(){
	
	
	
		$(".edit").click(function() {
			
		var winwidth = $(window).width();	
		var winheight = $(window).height()-300;	
			
			
		var id = $(this).attr('id');
		
		var className = $(this).attr('class');
		
		var field = className.replace('edit ', '');
		
		field =  field.replace(' hover', '');
		
		
		// console.log(field);
		
		$.fancybox.open({
					href : '<?=base_url();?>posts/modal_fetch/'+id+'/'+field,
					type : 'iframe',
					width: 915,
					height: 500,
					minHeight: 500,
					beforeShow: function(current, previous) {
     // $('.fancybox-outer').prepend('<div style="height: 36px; padding-top: 4px; margin-left: 850px;"><a class="btn btn-primary btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div>');
	 
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	 
	 
	   $('.fancybox-outer').append('<div style="border-top: 1px solid #CCC;"><div style="padding-top: 10px; padding-bottom: 6px; width: 90px; float: right; font-family: Helvetica, sans-serif;"><a class="btn btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div><div style="clear: both;"></div></div>');
	 
    				},
					padding : 0
				});
				
			
		}).children('a').click(function(e) { // make sure inner links still work
  return false;
});
		
		
		$(".add-button").click(function() {
			
			var col = $(this).attr('id');
			var page = $(this).data('page');
			col = col.replace('col-', '');
		
		
		$.fancybox.open({
					href : '<?=base_url();?>posts/modal_add/'+page+'/'+col,
					type : 'iframe',
					width: 915,
					height: 425,
					minHeight: 425,
					beforeShow: function(current, previous) {
     // $('.fancybox-outer').prepend('<div style="height: 36px; padding-top: 4px; margin-left: 850px;"><a class="btn btn-primary btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div>');
	 
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	 
	 
	     $('.fancybox-outer').append('<div style="border-top: 1px solid #CCC;"><div style="padding-top: 10px; padding-bottom: 6px; width: 90px; float: right; font-family: Helvetica, sans-serif;"><a class="btn btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div><div style="clear: both;"></div></div>');
	 
    				},
					padding : 0
				});
		});
		
		
		
		$(".manage-pages").click(function() {
			
		var winwidth = $(window).width()-200;	
		var winheight = $(window).height()-200;	
			
			
		var id = $(this).attr('id');
		
		var className = $(this).attr('class');
		
		var field = className.replace('edit ', '');
		
		field =  field.replace(' hover', '');
		
		
		// console.log(field);
		
		$.fancybox.open({
					href : '<?=base_url();?>dashboard/modal',
					type : 'iframe',
					width: winwidth,
					height: winheight,
					minHeight: winheight,
					beforeShow: function(current, previous) {
     
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	 
	 
	   $('.fancybox-outer').append('<div style="border-top: 1px solid #CCC;"><div style="padding-top: 10px; padding-bottom: 6px; width: 90px; float: right;"><a class="btn btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div><div style="clear: both;"></div></div>');
	 
    				},
					padding : 0
				});
				
			
		});
		
		
		
		
			
		$(".edit-dates").click(function() {
			
				var id = $(this).attr('id');
				id=id.replace('anchor-', '');
		
		var className = $(this).attr('class');
		
		var field = className.replace('edit ', '');
		
		field =  field.replace(' hover', '');
		
		
		// console.log(field);
		
		$.fancybox.open({
					href : '<?=base_url();?>dates/modal_edit/'+id,
					type : 'iframe',
					width: 950,
					height: 490,
					minHeight: 490,
							beforeShow: function(current, previous) {
  
	 
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	 
	 
	   $('.fancybox-outer').append('<div style="border-top: 1px solid #CCC;"><div style="padding-top: 10px; padding-bottom: 6px; width: 90px; float: right; font-family: Helvetica, sans-serif;"><a class="btn btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div><div style="clear: both;"></div></div>');
	 
    				},
					padding : 0
				});
		}).children('a').click(function(e) { // make sure inner links still work
  return false;
});
		
		
		$(".edit-dates").hover( function () {
		$(this).addClass("hover");
		},
		function () {
		$(this).removeClass("hover");
		});
		
		
				
		$(".add-date").click(function() {
			
	
		$.fancybox.open({
					href : '<?=base_url();?>dates/modal_edit/',
					type : 'iframe',
					width: 950,
					height: 490,
					minHeight: 490,
							beforeShow: function(current, previous) {
  
	 
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	 
	 
	   $('.fancybox-outer').append('<div style="border-top: 1px solid #CCC;"><div style="padding-top: 10px; padding-bottom: 6px; width: 90px; float: right; font-family: Helvetica, sans-serif;"><a class="btn btn-success in-head" href="javascript: void(0);" onclick="save_dialog();">Save</a></div><div style="clear: both;"></div></div>');
	 
    				},
					padding : 0
				});
		}).children('a').click(function(e) { // make sure inner links still work
  return false;
});
	
		
	
		
		$(".edit").hover( function () {
		$(this).addClass("hover");
		},
		function () {
		$(this).removeClass("hover");
		});
		
		
		
		$(".add").hover( function () {
		$(this).attr('src', '<?=base_url();?>application/plugins/icon-toolbar/buttons/add-button-over.png');
		},
		function () {
		$(this).attr('src', '<?=base_url();?>application/plugins/icon-toolbar/buttons/add.png');
		});
		
	
		
	
});

function save_dialog(){
	// call the save function in the iframe
	document.getElementById('fancy_frame').contentWindow.save_modal();
}

function close_dialog(){
	$.fancybox.close();
}

function fancyAdjust(){
	// call the save function in the iframe
	// $('#fancy_frame').css('height', '900px');
	$.fancybox.update();
}

</script>



<?php } ?>
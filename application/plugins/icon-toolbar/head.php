<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

<!-- toolbar
<link rel="stylesheet" href="<?=base_url();?>application/views/backend/toolbar.css" type="text/css" media="screen">
 -->




<script src="<?=base_url();?>application/sources/js/fancybox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>application/sources/js/fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />



<?php if(logged_in()){ ?>

<style type="text/css">
ul.images{
padding: 0;
margin: 0;	
}

ul.images li{
display: inline-block;	
}


.bbbut{
display: inline-block;
padding: 5px;

padding-bottom: 10px;
padding-left: 10px;
background-color: white;
border: 1px solid #CCC;
border-radius: 8px;
margin: 2px;	
width: 20px;
height: 20px;
}

.bbbut:hover{
background-color: #EEE;	
}

.toolbar-icons{
	right: 10px;

	top: 10px;
	position: fixed;
}

</style>


<script type="text/javascript">




$(document).ready(function(){
	
	
	
		$(".edit").click(function() {
		var id = $(this).attr('id');
		
		var className = $(this).attr('class');
		
		var field = className.replace('edit ', '');
		
		field =  field.replace(' hover', '');
		
		
		// console.log(field);
		
		$.fancybox.open({
					href : '<?=base_url();?>posts/fs_fetch/'+id+'/'+field,
					type : 'iframe',
					width: 950,
					height: 490,
					minHeight: 490,
					beforeShow: function(current, previous) {
     $('.fancybox-outer').prepend('<div style="height: 34px; padding-top: 6px; margin-left: 850px;"><a href="javascript: void(0);" onclick="save_dialog();"><img src="<?=base_url();?>application/sources/img/save.png" border="0" /></a></div>');
	 
	 $('.fancybox-outer iframe').attr('id', 'fancy_frame'); // reset the id of the frame, so we can call the save function later
	 
    				},
					padding : 0
				});
		});
		
		
		$(".edit").hover( function () {
		$(this).addClass("hover");
		},
		function () {
		$(this).removeClass("hover");
		});
		
	
	
});

function save_dialog(){
	// call the save function in the iframe
	document.getElementById('fancy_frame').contentWindow.save();
}



</script>

<style type="text/css">


.hover{
background-color: #FFFFE5;	
}

.fancybox-outer{
	
	 background-color: #EEEEEE;
    background-image: url("<?=base_url();?>application/sources/img/dialog_header.png");
    background-repeat: repeat-y;
   
    border-top-left-radius: 8px;
   
	

}




</style>

<?php 

}


 ?>



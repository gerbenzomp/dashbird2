<?php
$CI=&get_instance();
?>

<div id="navbar">

<div id="navbar-wrapper">
<a href="<?=base_url();?>" class="nav-button<?php if($CI->uri->segment(1)!='dashboard'){ echo " current"; } ?>">Website</a><a href="<?=base_url();?>dashboard" class="nav-button<?php if($CI->uri->segment(1)=='dashboard'){ echo " current"; } ?>">Instellingen</a>

<a class="nav-button" id="logout-button" style="float: right; width: 105px;" id="userinfo" href="<?=base_url();?>users/logout"><i style="margin-right: 7px; position: relative; top: -1px;"><img src="<?=base_url();?>application/plugins/icon-toolbar/navbar/img/user.png" /></i> <span class="small-hide"><?=ucwords($CI->session->userdata('username'));?></span></a>


<?php if($CI->uri->segment(1)!='dashboard'){ ?>
<a class="nav-button add-button" style="float: right;" id="col-main" data-page="<?=$CI->session->userdata('curpage');?>"><i style="margin-right: 7px; position: relative; top: -2px;"><img src="<?=base_url();?>application/plugins/icon-toolbar/navbar/img/plus.png" /></i><span class="small-hide"> Nieuw artikel schrijven</span></a>
<?php }else{ ?>
<a href="#!/add/posts" class="nav-button" style="float: right;" onclick="$('.current-item').removeClass('current-item');$('#posts').addClass('current-item');"><i style="margin-right: 7px;  position: relative; top: -2px;"><img src="<?=base_url();?>application/plugins/icon-toolbar/navbar/img/plus.png" /></i> <span class="small-hide">Nieuw artikel schrijven</span></a>
<?php } ?>

</div>

</div>

<script type="text/javascript">

$(document).ready(function(){
	$(document).on('mouseover', '#userinfo', function(){
		
		$(this).html('<i style="margin-right: 7px;  position: relative; top: -1px;"><img src="<?=base_url();?>application/plugins/icon-toolbar/navbar/img/arrow-right.png" /></i> <span class="lower">Log uit</span>');
		
	});
	
	$(document).on('mouseout', '#userinfo', function(){
		
		$(this).html('<i style="margin-right: 7px; position: relative; top: -1px;"><img src="<?=base_url();?>application/plugins/icon-toolbar/navbar/img/user.png" /></i> <span class="small-hide"><?=ucwords($CI->session->userdata('username'));?></span>');
		
	});
	
});

</script>
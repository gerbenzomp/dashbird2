<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PSi</title>

<link type="text/css" rel="stylesheet" href="<?=base_url();?>application/views/themes/psi/style.css" />
<link rel="icon" type="image/vnd.microsoft.icon" href="http://www.blogbird.nl/application/views/themes/psi/favicon.ico" />

<?=$head?>


<style type="text/css">

<?php
$ip = $_SERVER['REMOTE_ADDR'];
if($this->session->userdata($ip)){
	
	$img = $this->session->userdata($ip);

	
}
else // set the session
{
	$img = rand(1,8);
	$this->session->set_userdata($ip, $img);
	
}




?>


body{
background-image: url(<?=base_url();?>application/views/themes/psi/backgrounds/<?=$img;?>.jpg);	
}


</style>



<script language="javascript" src="http://cufon.shoqolate.com/js/cufon-yui.js"></script>
<script language="javascript" src="http://www.blogbird.nl/application/themes/psi/js/Futura_Std_700.font.js"></script>


<script type="text/javascript">
<?php if($this->uri->segment(2)!='detail'){ ?>
			Cufon.replace('h2');
			<?php } ?>
			Cufon.replace('.selected');
			
			Cufon.replace('b');
			
</script>



</head>

<body>




<div id="overlay"></div>

<div id="wrapper">



<div id="header"><a href="<?=my_url();?>"><img src="<?=base_url();?>application/views/themes/psi/img/header.png" border="0" /></a></div>


<div id="content">

<div id="menu">

</a></div>


<div id="content">

<div id="menu">
<div class="title">Not a member?</div>
   <a href="<?=base_url();?>register">Register here</a>    
            

</div>

<div id="maincontent">
 


<form id="form" name="form" method="post" action="<?=base_url();?>register/index">

<div class="title">Register</div>

<br />
<b>Your email</b>
<input type="text" name="email" size="35" value=""  class="styled-input" />
<br /><br />
 <b>Your password</b>
 
 <input type="password" name="password" id="password" size="35"  class="styled-input" />
<br /><br />

<button type="submit" class="uniform">Register</button>
<div class="spacer"></div>

</form>

</div>
</div>



</body>
</html>

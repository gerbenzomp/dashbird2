<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DashBird - Log In</title>

<meta name="viewport" content="width=device-width" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
 

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="<?=base_url();?>application/views/sparrow/style2.css" type="text/css" media="screen" />


</head>
<body>



<br /><br />



<div id="wrapper" style="width: 300px;">
 
<span style="float: left;"><img src="http://www.blogbird.nl/tools/img/logo.png" id="logo" /></span>
  


    
    <div id="head" style="height: 0px; padding: 0; border-radius: 8px;"></div>
    
    
<div id="content">

<div id="toolbar" style="border-left: 0; padding-left: 20px;"><h5 style="margin-top: 0px;">Log In</h5></div>




<div style="padding: 20px;">


<?=$this->load->view($maincontent);?>
</div>

</div>
</div>


<br /><br />

</body>
</html>
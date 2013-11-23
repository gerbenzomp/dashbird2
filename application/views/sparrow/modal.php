<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dashboard</title>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />


<!-- Bootstrap -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">


<!-- Ajax Upload -->
<link href="<?=base_url();?>application/modules/ajax_upload/js/mini-upload-form/assets/css/style.css" rel="stylesheet" />
<script src="<?=base_url();?>application/modules/ajax_upload/js/mini-upload-form/assets/js/jquery.iframe-transport.js"></script>
<script src="<?=base_url();?>application/modules/ajax_upload/js/mini-upload-form/assets/js/jquery.fileupload.js"></script>

<!-- Reveal -->
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/reveal/reveal.css" />	
<script type="text/javascript" src="<?=base_url();?>application/sources/js/reveal/jquery.reveal.js"></script>



<!-- Redactor -->
<script src="<?=base_url();?>application/sources/js/redactor901/redactor/redactor.js"></script>
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/redactor901/redactor/redactor.css" />

<!-- Zomp TinyTabs -->
<script src="<?=base_url();?>application/sources/js/tinytabs/tinytabs.js"></script>


<!-- App Styles and JS -->
<script type="text/javascript">
var base_url = '<?=base_url();?>';
</script>

<script src="<?=base_url();?>application/views/sparrow/main.js"></script>


<link rel="stylesheet" href="<?=base_url();?>application/views/sparrow/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>application/views/sparrow/responsive.css" type="text/css" media="screen" />



<style type="text/css">

body{
background: none;
background-color: white;	
background-image: url(<?=base_url();?>application/views/sparrow/img/modal-back.png);
background-repeat: repeat-x;
}

.wrapper{
width: 905px;

}

.window{
	padding: 20px;
	padding-left: 30px;
	padding-top: 5px;
}

#submit{
display: none;	
}

.hide-modal{
display: none;	
}

.tabs{

margin-bottom: 10px;
width: 100% !important;	
}


.handle{
display: block !important;	
}

.del{
display: none;	
}
</style>


</head>

<body>


<div class="wrapper">

<div class="window">
<?=$this->load->view($maincontent);?>
</div>

</div>


</body>
</html>
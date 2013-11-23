<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dashboard</title>



 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
 <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />
 
<link href="<?=base_url();?>application/sources/js/toolbar/bootstrap.icons.css" rel="stylesheet" />
<link href="<?=base_url();?>application/sources/js/bootstrap/css/bootstrap.css" rel="stylesheet" />

<link href="<?=base_url();?>application/sources/js/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />

<link href="<?=base_url();?>application/sources/js/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<link rel="stylesheet" href="<?=base_url();?>application/views/sparrow/style.css" type="text/css" media="screen" />


<!-- Ajax Upload -->
<link href="<?=base_url();?>application/modules/cloudupload/js/mini-upload-form/assets/css/style.css" rel="stylesheet" />
<script src="<?=base_url();?>application/modules/cloudupload/js/mini-upload-form/assets/js/jquery.iframe-transport.js"></script>
<script src="<?=base_url();?>application/modules/cloudupload/js/mini-upload-form/assets/js/jquery.fileupload.js"></script>


<!-- CSS Modal -->
<link href="<?=base_url();?>application/sources/js/css-modal/modal.css" rel="stylesheet" />
<script src="<?=base_url();?>application/sources/js/css-modal/modal.js"></script>

<!-- Pathjs -->
<script src="<?=base_url();?>application/sources/js/pathjs/path.min.js"></script>

<!-- Pagination -->
<script type="text/javascript" src="http://www.jquery4u.com/demos/jquery-quick-pagination/js/jquery.quick.pagination.min.js"></script>

<!-- Redactor -->
<script src="<?=base_url();?>application/sources/js/redactor901/redactor/redactor.js"></script>
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/redactor901/redactor/redactor.css" />


<!-- Zomp TinyTabs -->
<script src="<?=base_url();?>application/sources/js/tinytabs/tinytabs.js"></script>

<!-- Reveal -->
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/reveal/reveal.css" />	
<script type="text/javascript" src="<?=base_url();?>application/sources/js/reveal/jquery.reveal.js"></script>


<!-- Checkswitch -->
<script src="<?=base_url();?>application/sources/js/checkswitch/checkswitch.js"></script>
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/checkswitch/checkswitch.css" />


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
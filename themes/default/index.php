<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$title;?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href="<?=base_url();?>themes/dashbird/style.css" rel="stylesheet">


<?=hook('head');?>

</head>

<body>

<?=hook('after-body');?>


<div class="wrapper">

<div class="box">


<div class="header">
<?=$this->config->item('system');?>
</div>

<div class="content">

<div style="text-align: center;">Website coming soon</div>



</div>




</div>
</div>
<br />
<div style="text-align: center;"></div>

</div>

<?=hook('footer');?>

</body>
</html>



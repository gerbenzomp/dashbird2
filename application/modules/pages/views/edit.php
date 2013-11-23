


<form id="myform">

   <h5><?=$edit;?> Page</h5> 
    
    <label>Title</label>
    <input type="text" name="title" value="<?=$title;?>">

   <hr />
   
<?php


  $thm = themePrefs();
   if(isset($thm['pagetypes'])){
	   ?>
      <label>Type of page</label>
   <select name="type">
    <option value="standard"<?php if($type=='standard'){ echo " selected='selected'"; }?>>Normal page</option>
   <?php
 
	   foreach($thm['pagetypes'] as $item){
		   ?>
           <option value="<?=$item;?>"<?php if($type==$item){ echo " selected='selected'"; }?>><?=ucwords($item);?></option>
           <?php
		   
	   }
  
   ?>
   </select>
   <hr />
   <?php } ?>

 <!--  
   
   <label>Description</label>
    <textarea name="description" id="body" style="width: 100%;" rows="8"><?=$description;?></textarea>
  
 <br />
    <div id="message" style="display: none;"><div class="alert fade in"><button class="close" data-dismiss="alert" type="button">×</button><strong>Yes!</strong> Your post was saved.</div></div>
    
        <div id="empty" style="display: none;"><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error:</strong> Title can not be empty.</div></div>
    
    
    </fieldset>
    
    -->
    
</form>



   <?php /* if($id!=''){ ?> <hr /><span class="delete label label-important"><a href="javascript:void(0);" id="pages-<?=$id;?>">delete</a></span> Delete<?php } */ ?>


<script type="text/javascript">
load_redactor();

$().ready(function(){
	
	$('#save').html('<a class="button" onclick="save(\'pages\', \'<?=$id;?>\');">Save</a>');

});

</script>



<form id="myform">

    <h5><?=$edit;?> User</h5> 
    
    
 
    
<div class="control-group">
    <label class="control-label">Username</label>
    <div class="controls">
    <input type="text" name="username" value="<?=$username;?>">
</div>
</div>

<hr />


<div class="control-group">
    <label class="control-label">Password</label>
    <div class="controls">
    <input type="password" name="password" value="<?=$password;?>">
</div>
</div>

<hr />

<div class="control-group">
    <label class="control-label">Level</label>
    <div class="controls">
  <select name="level">
  <option value="1"<?php if($level==1){ echo " selected"; } ?>>User</option>
  <option value="2"<?php if($level==2){ echo " selected"; } ?>>Editor</option>
  <option value="5"<?php if($level==5){ echo " selected"; } ?>>Admin</option>
  </select>
   
</div>
</div>
   
   
     <?php /* if($id!=''){ ?> <hr /><span class="delete label label-important"><a href="javascript:void(0);" id="users-<?=$id;?>">delete</a></span> Delete<?php } */ ?>
   
   <br />
   
 
    
    <br><br>
    <div id="message" style="display: none;"><div class="alert fade in"><button class="close" data-dismiss="alert" type="button">×</button><strong>Yes!</strong> Your user was saved.</div></div>
    
       <div id="empty" style="display: none;"><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error:</strong> Username and password can not be empty.</div></div>
       
         <div id="exists" style="display: none;"><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button><strong>Error:</strong> This username already exists.</div></div>
    
    
    </fieldset>
    
    
    
    
    
</form>


<script type="text/javascript">
load_redactor();


$().ready(function(){
	
	$('#save').html('<a class="button" onclick="save(\'users\', \'<?=$id;?>\');">Save</a>');

});

</script>

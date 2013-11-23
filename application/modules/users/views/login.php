
 



      <form class="form-signin" action="<?=base_url();?>users/login" method="post">
      
      
<?php if(isset($error)){ ?>

 <div class="alert">
    
    <?=$error;?>
    </div>


<?php }else{ ?>

 
<?php } ?>
      
      
    
   
        <input name="username" type="text" class="input-block-level"  placeholder="Username">
        <input name="password" type="password" class="input-block-level" placeholder="Password">
        
        <!--
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
      
        <button class="btn btn-large" type="submit" style="width: 100%;">Log in</button>
      </form>

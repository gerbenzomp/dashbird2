



<script>
  $().ready(function(){
		  
	$('#tinytabs3').tinytabs({transition: 'fade'});	  
		
  });

</script>




<div id="tinytabs3">

    <ul class="tabs">
    
		<li><a href="#tab1" class="tinytabs current badge">General</a></li>
		<!-- <li><a href="#tab2" class="tinytabs badge">iDEAL</a></li> -->
		
	</ul>

    
<!-- <h5>Settings</h5> -->




 <div class="tabcontent">
 
 <form id="myform">
    
    	<div id="tab1" class="tinycontent">



 

   <div class="control-group">
										<label class="control-label">Site Title</label>
										<div class="controls">
											  <input type="text" name="title" size="40" value="<?=$blog->title;?>" />
                                                <span class="help-block">This will also appear in your site's title bar</span>
										</div>
                                      
									</div>
                                    
                                    <hr />
                                  
                                  <?php 
								  
								  // echo $this->session->userdata('blog_level');
								  if($this->session->userdata('blog_level')==1){ ?>
								  
									<div class="control-group">
										<label class="control-label">Theme</label>
										<div class="controls">
                                      
                                        
											 <select name="theme">
												
                                                <option value="demo1"<?php if($blog->theme=='demo1'){ echo " selected"; } ?>>Magazine</option>
                                                <option value="demo2"<?php if($blog->theme=='demo2'){ echo " selected"; } ?>>Magazine 2</option>
                                              
                                                </select>
										</div>
									</div>
                                    <hr />
                                    <?php
								  }
									?>
                                    
                                  
                                    
									<div class="control-group">
										<label class="control-label">Posts per page</label>
										<div class="controls">
											
   
   
   											<input type="text" name="per_page" size="2" value="<?=getSet('per_page');?>" class="input-mini" />
											
										</div>
									</div>
                                    
                               <hr />       
                    </div>
                                    
   	<div id="tab2" class="tinycontent">                                   
                     
         
         </div> 
         
  </form>
 </div> 

</div>


<script type="text/javascript">


$().ready(function(){
	
	$('#save').html('<a class="button" onclick="save(\'settings\', \'general\');">Save</a>');

});

</script>
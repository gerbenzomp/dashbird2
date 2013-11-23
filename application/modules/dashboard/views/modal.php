
<script>
  $().ready(function(){
		  
	$('#tinytabs2').tinytabs({transition: 'fade'});	  
		
  });

</script>






  
    <div id="tinytabs2">
    <ul class="tabs">
    
		<li><a href="#tab1" class="tinytabs current badge">Manage Posts</a> </li>
        
        	<li><a href="#tab2" class="tinytabs badge">Manage Pages</a> </li>
		
        
	</ul>
    
    
       <div class="tabcontent">
      
    
    
    	<div id="tab1" class="tinycontent">
        
           <div class="alert">Reorder all posts in this column by dragging them around</div>

   
   <?=modules::run('posts/postlist', $this->session->userdata('curpage'), 10);?>
        
        </div>
        
        
        <div id="tab2" class="tinycontent">
        
        

   
   <?=modules::run('ajax/manage', 'pages');?>
        
        </div>
        
      
        </div>
    
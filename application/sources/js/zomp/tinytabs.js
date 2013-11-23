    (function($){  
     $.fn.tinytabs = function(options) {  
          
      var defaults = { 
	   type: 'inline', // options: inline, ajax
	   ajaxdiv: 'window', // only define in case of ajax
	   transition: 'none', // options: none, fade
       tabclass: 'tinytabs',
	   contentclass: 'tinycontent'
      };  
        
      var options = $.extend(defaults, options);  
          
      return this.each(function() {  
	  
	  var tab = '#'+$(this).attr('id')+' .'+defaults.tabclass;
	  var content = '#'+$(this).attr('id')+' .'+defaults.contentclass;
	  var current = $('#'+$(this).attr('id')+' .current').attr('href');
	  var ajax = '#'+defaults.ajaxdiv;
      
		// let's keep it short
			
		$(content).hide();
		
		
		if(defaults.type=='ajax'){ 
			$(ajax).load(current, function(){
					
					// transition type
					if(defaults.transition=='none'){
						$(show).show();
					}
					
					if(defaults.transition=='fade'){
						$(show).fadeIn('slow');
					}
					
			});

		}
		else
		{
			$(current).show();
		}
		
		
		$(tab).click(function(event){
			
					event.preventDefault();
					
					$(content).hide();
		
					$(tab).removeClass('current');
			
			
			var show = $(this).attr('href');
			
			// check if we need to do an ajax transition
			if(defaults.type=='ajax'){ 
				$(ajax).load(show, function(){
					
					// transition type
					if(defaults.transition=='none'){
						$(show).show();
					}
					
					if(defaults.transition=='fade'){
						$(show).fadeIn('slow');
					}
					
				});
			}
			else
			{		
			
					
					// transition type
					if(defaults.transition=='none'){
						$(show).show();
					}
					
					if(defaults.transition=='fade'){
						$(show).fadeIn('slow');
					}
			}
			
			
			
			
			$(this).addClass('current');
			
			
		});
		
		

         
      });  
     };  
    })(jQuery);  
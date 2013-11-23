// JavaScript Document


 $(document).ready(function () {

// restores the currently active tab 
var cur_hash = document.location.hash;
var parts = cur_hash.split('/');



if(parts[1]!='dashboard' && parts[1] != 'manage'){
	$('.current-item').removeClass('current-item');
	$('#'+parts[1]).addClass('current-item');
}
		
// var int=setInterval(too_long, 1000);

		
 $(document).ajaxStart(function () { // wait for all ajax requests to stop
     
	$("#loading").show();
	
	// $('#info').html($(window).width());
	
 });
	

	
  $(document).ajaxStop(function () { // wait for all ajax requests to stop
      // $.active == 0 
	  
	   // clearInterval(int);
	 
	  $("#loading").fadeOut('fast');
	  
	 
	
	   if ($(window).width() < breakpoint_lo) {
			 
			 
			 
			  $('.close-nav').click();
		 
		
		 }
		
	
  });

 // this fixes the problem that if the current page is already open, the menu doesn't close when you click the nav button again
	$(document).on('click', '#nav a', function(){
		
		
		// get the current href
		var cur_href = $(this).attr('href');
		
		// get the current hash
		var cur_hash = document.location.hash;
		
		// if both are the same, close the navigation pane
		 if (cur_href==cur_hash && $(window).width() < breakpoint_lo) {
			
			  $('.close-nav').click();
		 
		 }
	
	});
	 
	 
		$(document).on('click', '.close-nav', function(){
	
		
		
			
			
			
			
		
		 $('#side').animate({
			
            marginLeft: '-322'
        }, 500, function () {
			
			//$('#open-pane').remove();
			
			$('.close-nav').addClass('open-nav');
			$('.close-nav').removeClass('close-nav');
			
		
					
						adjustMainOnResize();
			  
							
			
			
	
		});
		
	
	
	});
	

	$(document).on('click', '.open-nav', function(){

		// $('#nav').fadeIn();
		
			
			$('#save').hide();	
			

		
		 $('#side').animate({
			
            marginLeft: '0'
        }, 300, function () {
			
			
			$('.open-nav').addClass('close-nav');
			$('.open-nav').removeClass('open-nav');
			
		 		if ($(window).width() > breakpoint_lo) {
					adjustMain();
				}
	
		});
	
		
		
	
			
		
		
		
	});
	 
	 
	  $(document).on('focus', 'input', function (event) {
         $('#save').show();

         $('#preview').hide();

     });
	
	

    $(document).on('click', '.delete', function (event) {
         $('.delete a').html('Are your sure?');
		 
		 // $('.delete').css('background-color', '#C00 !important');

         $('.delete').attr('id', 'delete-sure');
		

     });

$(document).on('click', '#delete-sure', function (event) {

         var href = $('.delete a').attr('id');
         href = href.replace('-', '/');


         $.ajax({
             url: base_url+"ajax/delete/" + href,
             context: document.body
         }).done(function () {

             $('#myform').fadeOut('slow');

             var cur = href.split('/');

             // $('#nav').load(base_url+'ajax/side/' + cur[0]);
			 
			 if ( window.self === window.top ) { 
			
			window.location = base_url + 'dashboard#!/'+cur[0];
			  	  
			  
			  } else { 
			  
			 
			  parent.window.location = parent.window.location.href;
			  
			  }
			 
			

             //$(this).addClass("done");
         });

     });


     // $('input.default').ToggleInputValue();	

     $('#body, #extended').redactor({
         buttons: ['bold', 'italic', '|',
             'unorderedlist', 'orderedlist', '|',
             'image', 'video', 'file', 'table', 'link', '|',
             'alignleft', 'aligncenter', 'alignright', '|',
             'horizontalrule', '|', 'html'],
         minHeight: 250,
         imageUpload: base_url+'upload/upload_image'


     });
 });
 
 
 <!-- end document.ready() -->


 function load_redactor() {

     $('#body, #extended').redactor({
         buttons: ['bold', 'italic', '|',
             'unorderedlist', 'orderedlist', '|',
             'image', 'video', 'file', 'table', 'link', '|',
             'alignleft', 'aligncenter', 'alignright', '|',
             'horizontalrule', '|', 'html'],
         minHeight: 250,
         imageUpload: base_url+'upload/upload_image'


     });
	 
	 

 }
 
 function too_long(){
	 
	 	$("#loading").html('<img src="http://www.blogbird.nl/pro/application/sources/img/spinner.gif" /> This is taking quite a while now...');
	 
 }
 
 
 function toggleClass(id, classOpen, classClose, openit){
	 
	
	 
	 if(openit==1){
	 		$('#'+id).addClass(classOpen);
			$('#'+id).removeClass(classClose);
	 }
	 else
	 {
		 
		
		 $('#'+id).addClass(classClose);
		 $('#'+id).removeClass(classOpen);
	 }
 }
 
 
 function toggleDrawer(id){
		 
		 if($(id).hasClass('open')){
			 
			
			 $(id).slideUp('slow', function(){
				 $(id).removeClass('open'); 
			 });
		 }
		 else
		 {
			 
			 
			 $(id).slideDown('slow', function(){
				$(id).addClass('open'); 
			 });
		 }
		 
	 }
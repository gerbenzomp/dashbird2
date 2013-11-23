
<div class="upload-wrapper">


	<div id="header">Upload</div>
    
    <div id="uploadcontent">

		<form id="upload" method="post" action="<?=base_url();?>ajax_upload/do_upload/<?=$this->session->userdata('blog');?>/<?=$id;?>" enctype="multipart/form-data">
			<div id="drop">
		
				<a class="btn btn-large"><div id="label">Choose Image</div>
              
                
                  <div class="progress progress-striped active" id="progress" style="display: none; margin-top: 10px; margin-bottom: 5px;">
    <div class="bar" id="bar" style="width: 0%;"></div>
    </div>
                
                
                </a>
				<input type="file" name="userfile" multiple />
			</div>
          

            <div id="gallery">
            
            <?=modules::run('ajax_upload/uploadlist', $id);?>
            
            </div>

		</form>
        
   


<div id="urls" style="display: none;">


</div>
		
       </div> 
     
    
     <div style="clear: both;"></div>   
</div>
     
		<!-- JavaScript Includes -->
		<script src="<?=base_url();?>application/modules/cloudupload/js/mini-upload-form/assets/js/jquery.knob.js"></script>


<script type="text/javascript">





$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#09C" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.prependTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
           
			var jqXHR = data.submit().success(function(result, textStatus, jqXHR){
				
				
			
				var json = JSON.parse(result);
				var status = json['status'];
			
				if(status == 'error'){
					data.context.addClass('error');
					
					var error_msg = json['message'];
					
			error_msg = error_msg.replace('<p>', '');
			error_msg = error_msg.replace('</p>', '');		
					
			data.context.html('<div class="error alert">'+error_msg+'</div>');		 
	
	  
	 
	  $('#label').html('Choose Image');
					
				}
				else{
					
				
					
					
	
							
	
	 var filename = json['filename'];
	 var filetype = json['filetype'];
	 
	 var file_id = json['file_id'];
	 

	
	data.context.attr('id', 'page_'+file_id); // set the id for reordering and deleting
	 
	 data.context.find('canvas').hide().after('<div class="placeholder" style="background-image: url(<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/square/'+filename+'); background-size:55px 55px;"></div>');	
	
	data.context.find('span').hide().after('<div style="float: right; margin-top: -40px;"><a data-reveal-id="myModal" onclick=$("#details").load("<?=base_url();?>ajax_upload/edit/'+file_id+'");>Edit</a></div>');
	
	
	
		$( "#uploadlist" ).sortable({
		stop: function( event, ui ) {  save_files_order(); }
		
		});
	
	  
	  $('#progress').hide();
	  
	  $('#label').html('Choose Image');
	  
	  
	  
	  
	 
				}
			
			
			});
			
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();
			
			$('#progress').show();
			
		
			
			$('#label').html('Uploading...');
			
			
			$('#bar').css('width', progress+'%');

            if(progress == 100){
				
				data.context.removeClass('working');
				 
				
				
			$('#bar').css('width', '0%');
			
				
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
			
			
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});




</script>



